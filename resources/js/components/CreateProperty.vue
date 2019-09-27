<template>
  <div class="con">
    <h2>Create Property</h2><hr>
    <form action="" metod="post" @submit.prevent="createProperty">
      <div class="form-group">
        <label for="image">Image</label>
         
        <input  @change="onFileChange"
                ref="file" 
                type="file" 
                class="form-control pb-3"
                id="image"
                name="image"
                :class="{ 'is-invalid': submitted && $v.property.image.$error }">
        <div v-if="submitted && !$v.property.image.required " class="invalid-feedback">
          Image is required
        </div>
      </div> 
      <div class="row">
        <div class="col-sm-8">
          <label for="title">Title</label>
          <input v-model="property.title" 
                 type="text" 
                 class="form-control"
                 id="title"
                 name="title"
                 :class="{'is-invalid' : submitted && $v.property.title.$error }" >
          <div v-if="submitted && !$v.property.title.required" class="invalid-feedback">
            Title is required
          </div>
        </div>
        <div class="col-sm-4">
          <label for="price">Price</label>
          <input v-model="property.price" 
                 type="text" 
                 class="form-control"
                 id="price" 
                 name="price"
                 :class="{ 'is-invalid': submitted && $v.property.price.$error }">
           <div v-if="submitted && !$v.property.price.required.numeric" class="invalid-feedback">
             Price is required
           </div>
        </div>
      </div>
      <div class=" form-group ">
        <label>Action :</label> 
        <div class="form-control">
          <input v-model="property.action" 
                 class="ml-3"
                 type="radio" 
                 value="Rent" 
                 name="rentalType" 
          > Rent
          <input v-model="property.action" 
                 class="ml-3" 
                 type="radio" 
                 value="sale" 
                 name="rentalType" 
          > Sale
        </div>
      </div>
      <div class="form-group">
        {{ selectedTypes }}
        <label for="">Property Type</label>
        <select v-model="selectedTypes" multiple>
          <option v-for="(type,index) in typeList"
                :value="type.id"
                :key="index">
                {{ type.name }}
          </option>
        </select>
      </div>
      <div class=" form-group">
        <label for="description">Description</label>
        <textarea v-model="property.description" 
                  rows="3" 
                  class="form-control"
                  id="description"
                  name="description"
                  :class="{ 'is-invalid': submitted && $v.property.description.$error }"></textarea>
        <div v-if="submitted && !$v.property.description.required" class="invalid-feedback">
          Description id required
        </div>
      </div>
      <button type="submit" class="btn btn-success button">Submit</button>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
import { required,numeric } from "vuelidate/lib/validators";

export default {
  props:{
    propertydata: {
      type:Array,
      required:true
    },
  },

  data()
  {
    return {
      selectedTypes: [],
      typeList: [],
      list: [],
      property: {
        title: '',
        description: '',
        image:'',
        price:'',
        action:''
      } ,
      submitted : false
   }
  },
  validations: 
  {
    property: {
        title: { required },
        description: { required },
        image:{ required },
        price:{ required }, 
      }  
  },
  mounted()
  {
    console.log('mounted');
    this.fetchType();
    if(this.propertyData)
    {
      this.list = this.propertyData
    }
  },
  methods: {
    async fetchType () {
      let res = await axios.get('/propertytype')
      if (res.data) {
        this.typeList = res.data.types
      }
    },
    onFileChange(e)
    {
      this.property.image = this.$refs.file.files[0];
    },
    createImage(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.property.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    async createProperty() {

      this.submitted = true;
      this.$v.property.$touch();
      if(this.$v.$invalid)
      {
        return false;
      }

      let data = {
        title: this.property.title,
        description: this.property.description,
        image: this.property.image,
        price: this.property.price,
        types: this.selectedTypes,
        action:this.property.action
      }
      console.log(data);
      let property = new FormData();
      property.append('title', data.title);
      property.append('description', data.description);
      property.append('image', data.image);
      property.append('price', data.price);
      property.append('types',  JSON.stringify(data.types));
      property.append('action',data.action);
  
      let res = await axios.post('/property',property, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
      })
      this.property.title = '';
      this.property.description = '';
      this.property.image = '';
      this.property.price = '';
      this.property.typeList = '';
      this.property.action = '';
      this.list.push(res.data.property);
      this.$v.property.$reset()
    
      if (res.data.success) {
        this.$toaster.success('Your Data Enter successfully.');
        return true
      }
      this.$toaster.error('There is some error.')
      return false
    },
  }
}
</script>

<style>
.con {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width:50%;
}
</style>