<template>
  <div>
    <!-- Header -->
    <Toasts></Toasts>
    <div class="header bg-dongker pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav
                aria-label="breadcrumb"
                class="d-none d-md-inline-block ml-md-4"
              >
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item">
                    <a href="#"><i class="fas fa-user-crown"></i></a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Konfirmasi Pemilik Kos</a></li>
                </ol>
              </nav>
            </div>
            <!-- /col -->
          </div>
          <!-- /row -->
        </div>
        <!-- /header-body -->
      </div>
      <!-- /container-fluid -->
    </div>
    <!-- /header -->

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="header-body">
        <div class="row" v-if="allUsers && allUsers.data && allUsers.data.length > 0">
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 m-b-20" v-for="(user,index) in allUsers.data" :key="index">
            <div class="card">
              <img :src="storage + '/avatar/' + user.avatar" class="card-img-top img-admin-trx" alt="pemilik kos">
              <div class="card-body">
                <h5 class="card-title h4 mb-2">{{user.name}}</h5>
                <table class="table table-sm table-responsive table-fit">
                  <tr>
                    <td>No. Telp</td>
                    <td>:</td>
                    <td style="white-space: normal;">{{user.phone}}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="white-space: normal;">{{user.address}}</td>
                  </tr>
                </table>
                <center class="mt-3">
                  <button class="btn btn-success btn-sm m-r-0" @click="acceptOwner(user.id)">Terima</button>
                  <button class="btn btn-danger btn-sm" @click="declineOwner(user.id)">Tolak</button>
                </center>
              </div><!--/card-body-->
            </div><!--/card-->
          </div>
          <!-- /col-xl-12 mb-12 mb-xl-12 -->

          <div class="col col-12">
            <pagination
              :limit="2"
              class="mt-3"
              :align="'center'"
              :data="allUsers"
              @pagination-change-page="getOwnerKos"
            ></pagination>
          </div>

        </div>
        <!-- /row -->

        <div class="row justify-content-md-center mt-5" v-else>
          <div class="col-12">
            <div class="card shadow-none text-center pt-5 pb-5" style="background-color:transparent;">
              <div class="card-body mt-5 text-gray">
                <i class="fal fa-box-open fa-3x mt-5"></i>
                <p class="font-weight-bold mt-1">Data tidak tersedia.</p>
              </div>
            </div>
          </div>
        </div><!-- /row -->

      </div>
      <!-- /header-body -->
    </div>
    <!-- /container-fluid -->
  </div>
</template>

<script>
export default{
  props: ['storage'],
  data() {
    return {
      allUsers: {}
    }
  },
  methods: {
    getOwnerKos(page= 1){
      axios.get(`/admin/all-users?status=false&page=${page}`)
        .then(res => {
          this.allUsers = res.data
        })
    },
    declineOwner(id){
      axios.delete(`/admin/reject-user/${id}`)
        .then(res => {
          this.$toast.success(res.data.status);
          this.getOwnerKos();
        })
        .catch(err => {
          this.$toast.error(err.response.data.message);
        })
    },
    acceptOwner(id){
      axios.put(`/admin/accept-user/${id}`)
        .then(res => {
          this.$toast.success(res.data.status);
          this.getOwnerKos();
        })
        .catch(err => {
          this.$toast.error(err.response.data.message);
        })
    }
  },
  mounted() {
    this.getOwnerKos()
  }
}
</script>

<style>
.was-validated .form-control.select-admin:invalid, .form-control.is-invalid.select-admin {
  background-position: right calc(0.4em + 0.5875rem) center;
}
.file-btn {
  position: relative;
  overflow: hidden;
  cursor: pointer;
}
.fileupload {
  cursor: pointer;
  position: absolute;
  font-size: 50px;
  opacity: 0;
  right: 0;
  top: 0;
}
.bg-dongker {
  background-color: #172b4d;
}
.btn-green{
  background-color: #38c172;
  color: white;
  border: 2px solid white;
}
.btn-green:hover {
  color: white;
}
.img-admin-trx{
  height: 230px;
  width: auto;
  object-fit: cover;
}
.table-history.table td, .table-history.table th{
  padding: .5rem;
  vertical-align: initial;
}
.card .table-fit.table td, .card .table-fit.table th {
  padding-right: .5rem;
  padding-left: 0rem;
}
</style>
