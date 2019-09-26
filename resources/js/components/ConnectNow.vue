<template>
<div class="info container">
  <div class="row">
    <div class="container">
      <h2 class="info-title">REQUEST <span>MORE INFO</span></h2>
      <form action="" @submit.prevent="createInquery">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="fname">First Name </label>
              <input v-model="inquery.fname" 
                     type="text" 
                     class="form-control"
                     id="fname"
                     name="fname"
                     :class="{ 'is-invalid': submitted && $v.inquery.fname.$error }">
              <div v-if="submitted && !$v.inquery.fname.required" class="invalid-feedback">
                First Name is required
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="lname">Last Name </label>
              <input v-model="inquery.lname"
                     type="text" 
                     class="form-control"
                     id="lname"
                     name="lname"
                     :class="{ 'is-invalid': submitted && $v.inquery.lname.$error }">
              <div v-if="submitted && !$v.inquery.lname.required" class="invalid-feedback">
                Last Name is required
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="inquery.email" 
                 type="text" 
                 class="form-control"
                 id="email"
                 name="email"
                 :class="{ 'is-invalid': submitted && $v.inquery.email.$error }">
          <div v-if="submitted && !$v.inquery.email.$error" class="invalid-feedback">
            <span v-if="!$v.inquery.email.required">Email is required</span>
            <span v-if="!$v.inquery.email.email">Email is invalid</span>
          </div>
        </div>
        <div class="form-group">
            <label for="contactno">Contact Number</label>
            <input v-model="inquery.contactno" 
                  type="text" 
                  class="form-control"
                  id="contactno"
                  name="contactno"
                  :class="{ 'is-invalid': submitted && $v.inquery.contactno.$error }">
              <div v-if="submitted && !$v.inquery.contactno.$error" class="invalid-feedback">
                <span v-if="!$v.inquery.contactno.required.numeric">
                  Contact is required doesn't contain text
                </span>
                <span v-if="!$v.inquery.contactno.required.numeric">
                  Contact must be 10 number
                </span>
              </div>
        </div>
        <input type="hidden" :value="inquery.property_id">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea v-model="inquery.message" 
                      class="form-control" 
                      cols="30"
                      rows="5"
                      id="message"
                      name="message"
                      :class="{ 'is-invalid': submitted && $v.inquery.message.$error }"></textarea>
            <div v-if="submitted && !$v.inquery.message.required" class="invalid-feedback">
              Message is required
            </div>
        </div>
        <button class="con-btn">REQUEST INFO</button>
      </form>
    </div>
  </div>
</div>
</template>

<script>
import {
  required,
  email,
  minLength,
  numeric
} from "vuelidate/lib/validators/" ;
export default {
  props:{
    inquerydata: {
      type:Array,
      required:true
    },
    propertyId: {
      type: Number,
      required:false
    },
  },
  data() {
    return {
      list: [],
      inquery: {
        fname: '',
        lname: '',
        email: '',
        contactno: '',
        message: '',
        property_id:''
      },
      submitted: false
  }
  },
  validations:
  {
    inquery: {
      fname: { required },
      lname: { required },
      email: { required, email },
      contactno: { required , minLength: minLength(10) , numeric },
      message: { required }
    }
  },
  mounted()
  {
    console.log('mounted');
    if(this.inquerydata)
    {
      this.list = this.inquerydata
    }
    this.inquery.property_id = this.propertyId
  },
  methods: {
    async createInquery(){
      this.submitted = true;
      this.$v.inquery.$touch()
      if (this.$v.$invalid) {
        return false
      }

      let data = {
          fname: this.inquery.fname,
          lname: this.inquery.lname,
          email: this.inquery.email,
          contactno: this.inquery.contactno,
          message: this.inquery.message,
          property_id: this.inquery.property_id
      }
      console.log(data);
      let res = await axios.post('/connect',data)
          this.inquery.fname = '';
          this.inquery.lname = '';
          this.inquery.email = '';
          this.inquery.contactno = '';
          this.inquery.message = '';
          this.inquery.property_id = '';
          this.list.push(res.data.inquery);
          this.$v.inquery.$reset()
          if(res.data.success)
          {
            this.$toaster.success('Your Request has been sent')
            return true
          }
          this.$toaster.error ('There is some error')
          return false
    }
  }
}
</script>

<style>
.info{
  background:#d9d9d9;
  padding: 3%;
  height: 75%;
  width: 60%;
  border-radius: 10px 10px ; 
}
.con-btn{
  background: #16a89c;
  color: white;
  width: 80%;
  margin: 0 3% 0 9%;
  padding: 5px;
  border-radius: 10px 10px;
}
.info-title
{
  background: #16a89c;
  color: white;
  border-radius: 10px 10px;
  padding-left: 1%;
}
</style>