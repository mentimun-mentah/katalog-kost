<template>
  <div>
    <Toasts></Toasts>
    <div class="card-container card">
      <div class="bg-transparent border-bottom card-header">
        <h5 class="mt-1 mb-0 font-weight-bold">Edit Kos</h5>
      </div>
      <!--/card-header-->
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6 col-sm-12 mb-0">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Cari Kos"
                  v-model="search"
                />
              </div>
              <div class="form-group col-md-6 col-sm-12 mb-0">
                <select class="custom-select" v-model="selected">
                  <option v-for="option in options" :value="option.value">{{option.text}}</option>
                </select>
              </div>
            </div>
            <!--/form-row-->
          </div>
        </div>
      </div>
      <!--/row-->

      <div class="card-body pt-0">
        <div class="row" v-if="allKosts && allKosts.data && allKosts.data.length > 0">
          <div class="col-sm-12 col-md-6 col-lg-4 mb-3" v-for="(kost, index) in allKosts.data" :key="index">
            <div class="card shadow-card bor-rad-top-10 mt-2 mb-2">
              <img 
                class="card-img-top bor-rad-top-10 img-fit kost-img" 
                :src="storage + '/kosts/' + kost.image" 
                alt="Card image cap"
              >
              <div class="card-body">
                <h5 class="card-title font-weight-bold text-truncate">{{kost.name}}</h5>
                <p class="fs-16">
                  Rp.{{formatNumber(kost.price)}}
                  <small class="fs-14">/ bulan</small>
                </p>
                <p class="card-text fs-12 text-secondary text-truncate">
                  <i class="fal fa-map-marker-alt"></i>
                  {{kost.address}}
                </p>
                <div class="row">
                  <div class="col-6 text-center">
                    <a :href="home + '/kosts/change-kost/' + kost.id" type="button" class="btn btn-green btn-block btn-sm">Ubah</a>
                  </div><!--/col-6-->
                  <div class="col-6 text-center">
                    <button type="button" class="btn btn-danger btn-block btn-sm" @click="deleteKost(kost.id)">Hapus</button>
                  </div><!--/col-6-->
                </div><!--/row-->
              </div>
              <div class="card-footer text-muted bg-white bor-rad-10">
                <div class="fs-11 row">
                  <div class="col-auto mr-auto text-truncate col">
                    <span class="float-right fs-11 font-weight-bold">
                      jumlah kamar : {{kost.total_rooms}}
                    </span>
                  </div>
                  <div class="col-auto col-md-auto col-lg-auto col-xl-auto  col">
                    <span class="float-right fs-11 font-weight-bold hov_pointer">
                      <i class="far fa-star"></i> {{kost.score ? parseFloat(kost.score).toFixed(1) : 0}}
                    </span>
                  </div>
                </div>
              </div>
            </div><!--/card-->
          </div><!--/col-->
        </div><!--/row-->

        <div class="row justify-content-md-center" v-else>
          <div class="col-12">
            <div class="card shadow-none text-center pt-3 pb-5 border-0" style="background-color:transparent;">
              <div class="card-body text-muted">
                <i class="fal fa-box-open fa-3x mt-5"></i>
                <p class="font-weight-bold mt-1">Data tidak tersedia.</p>
              </div>
            </div>
          </div>
        </div><!-- /row -->

        <pagination
          :data="allKosts"
          :limit="2"
          :align="'center'"
          @pagination-change-page="getAllKosts"
        ></pagination>

      </div><!--/container-->

    </div>
  </div>
</template>

<script>
export default {
  props: ['home','storage'],
  data() {
    return {
      search: "",
      selected: "",
      allKosts: {},
      options: [
        {text: 'Semua', value: ''},
        {text: 'Mahasiswa', value: 'mahasiswa'},
        {text: 'Umum', value: 'umum'},
      ]
    }
  },
  methods: {
    getAllKosts(page = 1){
      axios.get(`/kosts/get-my-kost?page=${page}&q=${this.search}&category=${this.selected}`)
        .then(res => {
          this.allKosts = res.data
        })
    },
    deleteKost(id){
      axios.delete(`/kosts/delete-kost/${id}`)
        .then(res => {
          this.$toast.success(res.data.status);
          this.getAllKosts();
        })
        .catch(err => {
          this.$toast.error(err.response.data.message);
        })
    },
    formatNumber(val) {
      return new Intl.NumberFormat(['ban', 'id']).format(val);
    },
  },
  watch: {
    search(val){
      if(val.length > 2){
        this.getAllKosts()
      } else this.getAllKosts()
    },
    selected(val){
      this.getAllKosts()
    }
  },
  mounted() {
    this.getAllKosts()
  }
}
</script>

<style>
.kost-img {
  height: 200px;
  width: 100%;
  object-fit: cover;
}
</style>
