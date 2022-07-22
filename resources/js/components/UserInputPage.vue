<template>
       <div class="container mt-3">
            <h2>User Input Form</h2>
<form class=" ps-lg-4 w-lg-80" v-on:submit="addUser">
  <div class="form-group">
    <div class="row">
        <div class="col-sm">
            <label for="firstName">First Name</label>
            <input type="text"  v-model="name.firstName" class="form-control" :class="{ 'is-invalid':firstNameErr}" id="firstName"  placeholder="Enter first name">
            <div class="invalid-feedback d-block" id="feedback-1" v-if="firstNameErr">
                Must be 1-20 characters long.
            </div>
        </div>
        <div class="col-sm">
            <label for="lastName">Last Name</label>
            <input type="text" v-model="name.lastName" class="form-control" :class="{ 'is-invalid':lastNameErr}" id="lastName"  placeholder="Enter last name">
            <div class="invalid-feedback d-block" id="feedback-1" v-if="lastNameErr">
                Must be 2-50 characters long.
            </div>
        </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
    <label for="exampleInputEmail1">Contact Number</label>
        <div class="col-sm-3">
            <select class="form-select" v-model="phone.dialCode" :class="{ 'is-invalid':phoneCodeErr}">
                <option disabled value="">Please Select Country Code</option>
                <option  v-for="(country, index) in countryCodeList" :key="index" :value="country.dial_code">{{country.name}} ({{country.dial_code}})</option>
            </select>
        <div class="invalid-feedback d-block" id="feedback-1" v-if="phoneCodeErr">
            Please select Country Code.
        </div>        
        </div>
        <div class="col-sm-9">
            <input  type="number" class="form-control" :class="{ 'is-invalid':phoneNumberErr}" id="phoneNumber"  v-model="phone.phoneNumber" placeholder="Enter phone number">
            <div class="invalid-feedback d-block" id="feedback-1" v-if="phoneNumberErr">
                Please insert valid phone number.
            </div>
        </div>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email"  v-model="email" class="form-control" :class="{ 'is-invalid':emailErr}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <div class="invalid-feedback d-block" v-if="emailErr">
        Please insert valid email.
    </div>
  </div>
    <div class="form-group has-error has-feedback" >
    <label for="exampleInputEmail1">Website/LinkedIn Profile URL</label>
    <input type="text" v-model="urlLink" class="form-control" :class="{ 'is-invalid':urlLinkErr}" id="exampleInputEmail1" placeholder="Enter url link">
    <div class="invalid-feedback d-block" v-if="urlLinkErr">
        Please insert valid url.
    </div>
  </div>
  <button type="submit" class="btn btn-primary float-end mt-2">Preview</button>
</form>
    </div>

</template>

<script>
    import json from '../../../resources/assets/json/countryCodeList.json';
    import axios from  'axios'
    export default {
        props : ['userData'],
        data: function () {
            return {
                infoData:JSON.parse(this.userData),
                loading: true,
                countryCodeList:json,
                name:{
                    firstName:"",
                    lastName:"",
                },
                phone:{
                    dialCode:"",
                    phoneNumber:"",
                },
                email:"",
                urlLink:"",

                firstNameErr:false,
                lastNameErr:false,
                phoneCodeErr:false,
                phoneNumberErr:false,
                emailErr:false,
                urlLinkErr:false,
            }
        },
        mounted() {
            if(this.infoData){
                this.name.firstName = this.infoData?.name?.firstName;
                this.name.lastName = this.infoData?.name?.lastName;
                this.phone.dialCode= this.infoData?.phone?.dialCode
                this.phone.phoneNumber= this.infoData?.phone?.phoneNumber
                this.email = this.infoData?.email;
                this.urlLink = this.infoData?.urlLink;
            }
        },
        methods: {
            validate() {
                //close all error
                this.firstNameErr=false;
                this.lastNameErr=false;
                this.phoneCodeErr=false;
                this.phoneNumberErr=false;
                this.emailErr=false;
                this.urlLinkErr=false;

                //validate start
                const firstNameLen= this.name.firstName?.length??0;
                if(firstNameLen<1||firstNameLen>20){
                    this.firstNameErr=true;
                }
                const lastNameLen= this.name.lastName?.length??0;
                if(lastNameLen<2||lastNameLen>50){
                    this.lastNameErr=true;
                }
                if(!this.phone.dialCode){
                    this.phoneCodeErr=true;
                }
                const phoneNumberLen= this.phone.phoneNumber?.length??0;
                if(phoneNumberLen<8||phoneNumberLen>12){
                    this.phoneNumberErr=true;
                }
                const emailValidate=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if(!emailValidate.test(this.email)){
                    this.emailErr=true;
                }
                const websiteValidate=new RegExp('^(https?:\\/\\/)?'+ // protocol
                    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
                const linkedinValidate=/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/gm;
                if(!linkedinValidate.test(this.urlLink)&&!websiteValidate.test(this.urlLink)){
                    this.urlLinkErr=true;
                }
	        },
            change:function(e){
            const url = e.target.value
            this.isURLValid(url);
            },
            isURLValid: function(inputUrl) {
            this.isValid=   this.regex.test(inputUrl)
            },
            addUser(e){
                e.preventDefault() // it prevent from page reload
                this.validate();
                if (
                    !this.firstNameErr&&
                    !this.lastNameErr&&
                    !this.phoneCodeErr&&
                    !this.phoneNumberErr&&
                    !this.emailErr&&
                    !this.urlLinkErr
                ){
                    axios.post('api/store',{  
                        name: this.name, 
                        phone:this.phone,
                        email:this.email,
                        urlLink:this.urlLink,
                    })
                    .then((res)=> {
                            window.location.href = "/view";
                        })
                }

            }
        }
    }
    
</script>