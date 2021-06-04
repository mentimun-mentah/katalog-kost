<template>
  <div>
    <Toasts></Toasts>
    <div class="card-container card">
      <div class="bg-transparent border-bottom card-header">
        <h5 class="mt-1 mb-0 font-weight-bold">Akun Saya</h5>
        <p class="mb-0">
            Kelola informasi profil Anda untuk mengontrol dan melindungi
            akun anda
        </p>
      </div>
       <!--/card-header-->
       <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-8 border-right">
           <div class="card-body">
             <div class="form-row">
               <div class="form-group col-md-6">
                 <label for="inputEmail4">Username</label>
                 <input
                     type="text"
                     class="form-control"
                     id="inputEmail5"
                     placeholder="Username"
                     v-model="user.name"
                 />
                 <small class="text-danger" v-if="errors.name">
                    {{ errors.name[0] }}
                  </small>
               </div>
               <div class="form-group col-md-6">
                 <label for="inputEmail6">Email</label>
                 <input
                     disabled
                     type="email"
                     class="form-control"
                     id="inputEmail7"
                     v-model="user.email"
                 />
                 <small class="text-danger" v-if="errors.email">
                   {{ errors.email[0] }}
                 </small>
               </div>
               <div class="form-group col-md-6">
                 <label for="inputEmail4">Nama Lengkap</label>
                 <input
                     type="text"
                     class="form-control"
                     id="inputEmail4"
                     placeholder="Nama Lengkap"
                     v-model="user.fullname"
                 />
                 <small class="text-danger" v-if="errors.fullname">
                   {{ errors.fullname[0] }}
                 </small>
               </div>
               <div class="form-group col-md-6">
                 <label for="inputPassword4"
                     >Nomor Telepon</label
                 >
                 <input
                     type="text"
                     class="form-control"
                     id="inputPassword4"
                     placeholder="Nomor Telepon"
                     v-model="user.phone"
                 />
                 <small class="text-danger" v-if="errors.phone">
                   {{ errors.phone[0] }}
                 </small>
               </div>

               <div class="form-group col-md-12">
                 <label for="inputEmail4">Alamat</label>
                 <textarea
                     class="form-control"
                     placeholder="Alamat"
                     rows="2"
                     v-model="user.address"
                 ></textarea>
                 <small class="text-danger" v-if="errors.address">
                   {{ errors.address[0] }}
                 </small>
               </div>
             </div>
             <!--/form-row-->

             <button class="btn btn-green float-right mb-3" @click="updateUser()">
               Simpan
             </button>
           </div>
           <!--/card-body-->
         </div>
         <!--/col-->

         <div class="col-sm-12 col-md-12 col-lg-4 pl-0">
           <div class="card-body text-center">
             <img
               :src="storage + '/avatar/' + user.avatar"
               width="100"
               height="100"
               class="img-thumbnail rounded-circle mx-auto d-block img-square-100"
               alt="profile"
             />
             <div class="file-btn btn btn-sm button border mt-2 left-0">
               Pilih Foto
               <input
                   type="file"
                   class="fileupload"
                   name="file"
                   accept="image/*"
                   @change="updateAvatar"
               />
             </div>

             <p class="fs-12 mb-0 mt-2 text-secondary mt-0">
               Ukuran gambar: maks. 1 MB
             </p>
             <p class="fs-12 mb-0 text-secondary mt-0">
               Format gambar: .JPEG, .JPG, .PNG
             </p>
           </div>
           <!--/card-body-->
         </div>
         <!--/col-->
       </div>
       <!--/row-->
    </div>
    <!--/card-container-->

  </div>
</template>

<script>
export default {
  props: ["storage"],
  data() {
    return {
      user: null,
      errors: []
    };
  },
  methods: {
    updateAvatar(e){
      let formData = new FormData();
      formData.append("avatar", e.target.files[0]);
      const config = {
        headers: { "content-type": "multipart/form-data" }
      };
      axios
        .post("/account/update-avatar", formData, config)
        .then(res => {
          location.reload();
        })
        .catch(err => {
          this.$toast.error(err.response.data.errors.avatar[0]);
        });
    },
    updateUser(){
      let user = {
        fullname: this.user.fullname,
        name: this.user.name,
        phone: this.user.phone,
        address: this.user.address
      }

      axios.put("/account/update-profile", user).then(res => {
          this.$toast.success(res.data.status);
          this.errors = [];
      }).catch(err => {
          this.errors = err.response.data.errors;
      })
    },
    getUser() {
      axios.get("/user").then(res => {
        this.user = res.data;
      });
    }
  },
  mounted() {
    this.getUser();
  }
}
</script>

<style>
.img-square-100 {
  width: 100px;
  height: 100px;
}
.file-btn.left-0 {
  left: 0%;
}
</style>
