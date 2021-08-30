<template>
  <div>
    <!-- Header -->
    <Toasts></Toasts>
    <div class="header bg-dongker pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-user-cog"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Kelola Pemilik Kos</a></li>
                </ol>
              </nav>
            </div><!-- /col -->
          </div><!-- /row -->
        </div><!-- /header-body -->
      </div><!-- /container-fluid -->
    </div><!-- /header -->

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
                  <tr>
                    <td>No. Izin Bangunan</td>
                    <td>:</td>
                    <td style="white-space: normal;">{{user.izin_bangunan}}</td>
                  </tr>
                </table>
                <center class="mt-3">
                  <button class="btn btn-danger btn-sm" @click="deleteOwner(user.id)">Hapus Pemilik</button>
                </center>
              </div><!--/card-body-->
            </div><!--/card-->
          </div><!--/col-xl-4-->

          <div class="col col-12">
            <pagination
              :limit="2"
              class="mt-3"
              :align="'center'"
              :data="allUsers"
              @pagination-change-page="getOwnerKos"
            ></pagination>
          </div>

        </div><!-- /row -->

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

      </div><!-- /header-body -->
    </div><!-- /container-fluid -->
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
      axios.get(`/admin/all-users?status=true&page=${page}`)
        .then(res => {
          this.allUsers = res.data
        })
    },
    deleteOwner(id){
      axios.delete(`/admin/delete-user/${id}`)
        .then(res => {
          this.$toast.success(res.data.status);
          this.getOwnerKos();
        })
        .catch(err => {
          this.$toast.error(err.response.data.message);
        })
    },
  },
  mounted() {
    this.getOwnerKos()
  }
}
</script>

<style>
.truncate-3 {
  -webkit-line-clamp: 3;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-box-orient: vertical;
}
.has-search.has-search-admin .form-control-feedback {
  width: 2.875rem;
  height: 2.875rem;
  line-height: 2.875rem;
}
.obj-fit-cover {
  object-fit: cover;
}
</style>

