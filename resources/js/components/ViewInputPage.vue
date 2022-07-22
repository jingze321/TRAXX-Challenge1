<template>
<div
      class="d-flex align-items-center justify-content-center "
      style="min-height: 100vh;"
id="app"
    >
      <!-- <div class="bg-warning" style="width: 150; height: 100">123</div> -->
    <div class="border p-lg-5 p-sm-2 w-50">
        <div  role="alert" data-mdb-color="primary">
          <p class="fw-bold fs-4">First Name: <span class="fw-normal fs-3">{{infoData.name.firstName}}</span></p>
          <p class="fw-bold fs-4">Last Name: <span class="fw-normal fs-3">{{infoData.name.lastName}}</span></p>
        </div>
        <div  role="alert" data-mdb-color="primary">
          <p class="fw-bold fs-4">Contact Number: 
            <span class="fw-normal fs-3">
              <img :src="getImgUrl(fetchCountryCode.code)"/>
              <a class="text-black text-decoration-none" :href="'tel://'+infoData.phone.dialCode+infoData.phone.phoneNumber">
                {{infoData.phone.dialCode}} {{infoData.phone.phoneNumber}}
              </a>
            </span>
          </p>
        </div>
        <div  role="alert" data-mdb-color="primary">
          <p class="fw-bold fs-4">Email: 
            <span class="fw-normal fs-3">
              <a class="text-black text-decoration-none" :href="'mailto:'+infoData.email">
                {{infoData.email}}
              </a>
            </span>
          </p>
        </div>
        <div  role="alert" data-mdb-color="primary">
          <p class="fw-bold fs-4">Website/LinkedIn Profile URL: 
            <span class="fw-normal fs-3">
              <a class="text-black text-decoration-none" :href="'//'+infoData.urlLink" target="_blank">{{infoData.urlLink}}</a>
            </span>
          </p>
        </div>
        <div class="float-end">
          <a type="button" href='/' class="btn btn-secondary">Back</a>
          <button @click="submitData" type="button" class="btn btn-success">Submit </button>
        </div>
      </div>
    </div>
</template>

<script>
        import axios from  'axios'
        // import json from '../../../resources/assets/json/countryCodeList.json';
        import json from '../../../resources/assets/json/countryCodeList.json';
        export default {
        props : ['userData'],
        data(){
            return {
              infoData:JSON.parse(this.userData),
              countryCodeList:json,
              fetchCountryCode :"",
            }
        },
        // created: function(){
        //     this.getItem();
        // },
        mounted(){

          if(this.infoData&&this.countryCodeList){
            this.fetchCountryCode=this.countryCodeList.find(country=>country.dial_code===this.infoData.phone.dialCode)
          }
        },
         methods: {
           submitData(){
              //  this.$router.push({name: 'welcome'});
              axios.post('api/save',this.infoData)
                .then((res)=> {
                  alert(res.data);
                  window.location.href = "/";
                }
              )
           },
          getImgUrl(code){
            if (code){
              const countryCode = code.toLowerCase();
              return "https://flagcdn.com/w40/"+countryCode+".png";
            }
          }
        },
            // getItem()
            // {
            //   let uri = `http://localhost:8000/items/${this.$route.params.id}/edit`;
            //     this.axios.get(uri).then((response) => {
            //         this.item = response.data;
            //     });
            // },

            // updateItem()
            // {
            //   let uri = 'http://localhost:8000/items/'+this.$route.params.id;
            //     this.axios.patch(uri, this.item).then((response) => {
            //       this.$router.push({name: 'DisplayItem'});
            //     });
            // }
    }
</script>