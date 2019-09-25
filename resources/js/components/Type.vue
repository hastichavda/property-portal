<template>
 <div class="con">
   <div class="container">
     <form @submit.prevent="createType">
      <div class="form-group">
        <h2>Create Type</h2>
        <hr>
        <div class="form-group">
          <label for="">Type</label>
          <input type="text" class="form-control" v-model="type.name" :class="{ 'is-invalid': submitted && $v.type.name.$error }">
          <div v-if="submitted && !$v.type.name.required" class="invalid-feedback">First Name is required</div>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Add type</button>
     </form>
   </div>
   <div>
     <ul>
       <p v-if="list.length === 0">There is no categories yet!</p>
       <li class="list-group-item" v-for="(type, index) in list" :key="index">
         {{ type.name }}
         <div style="text-align: right">
           <button data-inline="true" @click="deleteType(type.id,index)" class="btn btn-danger">Delete</button>
         </div>
       </li>
     </ul>
   </div>
 </div>
</template>
<script>
import { required } from "vuelidate/lib/validators";
export default {
 props: {
   typedata: {
     type: Array,
     required: true
   },
 },
 data() {
   return {
     list: [],
     type: {
       name: ''
     },
     submitted:false
   };
 },
 validation: {
   type: {
     name: { required }
   }
 },
 mounted() {
   console.log('mounted');
   if(this.typedata)
   {
     this.list = this.typedata
   }
 },
 methods: {
   async createType()
   {
     let data = {
       name: this.type.name
     }
     console.log(data);
     let res = await axios.post('/propertytype',data)
         this.type.name = '';
         this.list.push(res.data.type);

         if(res.data.success)
         {
           this.$toaster.success('Entered Successfully');
           return true;
         }
         this.$toaster.error('There is some error.');
         return false;
        this.submitted = true;
         this.$v.$touch();
              if (this.$v.$invalid) {
                  return ;
              }
   },
   deleteType(id, index)
   {
     axios.delete('/propertytype/' +id)
       .then((res) => {
         this.list.splice(index,1)
       })
       .catch((err) => console.error(err));
   }
 }
};
</script>

<style>
.con 
{
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width:70%;
}
</style>