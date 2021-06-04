<template>
<div>
  <div class="jumbotron jum-bg mb-0 rounded-0">
    <div class="hero-text">
      <h1 class="display-4 text-white font-weight-normal">Bingung Mau Cari Kos Dimana?</h1>
      <p class="lead font-weight-normal">Dapatkan infonya dan langsung sewa di Katalog Kos.</p>
      <div class="container d-flex justify-content-center">
        <div class="search-container ">
          <div class="btn-search">
            <span class="far fa-search fa-1-5 form-control-feedback"></span>
            <input type="text" class="form-control border-0 no-border ml-2" placeholder="Masukkan alamat" v-model="search">
            <div class="btn-find-search">
              <span class="btn-search-label" @click="searchKost">
                Cari
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container mb-5">
  <section class="mt-4">
    <h2 class="font-weight-normal">Kos Terbaru</h2>
    <p class="text-muted">
      Masih bingung cari kos di daerah Kuta Selatan? daftarkan kos anda sekarang.
    </p>
    <div class="row mt-4" v-if="newestKost && newestKost.length > 0">
      <div class="col-lg-4" v-for="kost in newestKost" :key="kost.id">
        <div class="card shadow-card bor-rad-top-10 mt-2 mb-2">
          <img class="card-img-top bor-rad-top-10 img-fit kost-img" 
            :src="storage + '/kosts/' + kost.image" 
            alt="Card image cap"
            >
          <div class="card-body">
            <h5 class="card-title font-weight-bold text-truncate">
              <a :href="home + '/detail-kos/' + kost.slug + '/' + kost.user_id" class="text-reset">
                {{kost.name}}
              </a>
            </h5>
            <p class="fs-16">
            Rp.{{formatNumber(kost.price)}}
              <small class="fs-14">/ bulan</small>
            </p>
            <p class="card-text fs-12 text-secondary text-truncate">
              <i class="fal fa-map-marker-alt"></i>
              {{kost.address}}
            </p>
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
                  <i class="far fa-star"></i>
                  {{kost.score ? parseFloat(kost.score).toFixed(1) : 0}}
                </span>
              </div>
            </div>
          </div>
        </div><!--/card-->
      </div>
    </div><!--/row-->

    <div class="text-center py-5 text-muted" v-else>
      <i class="fad fa-boxes-alt fa-4x"></i>
      <p class="mt-2 mb-0">Tidak ada data</p>
    </div>
    <a :href="home + '/list-kos'" type="button" class="mt-4 btn btn-outline-dark float-right">
      Selengkapnya &nbsp;
      <i class="far fa-chevron-right"></i>
    </a>
  </section>
</div>
<section id="tentangkami" class="discover-propt">
  <div class="overlay-bg"></div>
  <div class="container">
    <div  class="discover-text text-white">
      <h3 class="pb-2">Cara Cerdas Cari Kos di Daerah Kuta Selatan</h3>
      <p>
        <b>Katalog Kos Online</b> dalah sebuah platform yang menyediakan informasi mengenai hunian kos yang disewakan di daerah Kuta Selatan dilengkapi dengan harga kos, fasilitas kos dan gambar kos yang diunggah langsung oleh pemilik kos. Platform kami memberikan kemudahan bagi kamu yang mencari info kos terdekat di sekitaran kampus atau Universitas yang kamu inginkan.
      </p>
      <p>
        Kemudahan yang diberikan situs kami adalah dengan adanya GIS pada website kami, dimana fitur yang terdapat pada sistem GIS ini dapat mengurutkan dan mencari lokasi dari kos tersebut, fitur ini juga mampu memperlihatkan informasi secara lengkap mulai dari tempat kos yang tersedia, yaitu berupa harga, fasilitas, rating dan foto dari tempat kos tersebut, tentunya fitur ini akan sangat membantu mendapatkan kos yang sesuai dengan lebih cepat.
      </p>
      <p>
        Informasi kos yang disewakan juga langsung diberikan oleh pemilik, yang pastinya sudah terkurasi kebenarannya oleh tim kami. Kemudahan juga pastinya diberikan tidak hanya kepada pencari kos, tapi juga kepada pihak pemilik kos-kosan untuk dapat memasang informasi kos yang disewakan. 
      </p>
    </div>
  </div>
</section>

<div class="container mb-4">
  <section class="mt-4">
    <h2 class="font-weight-normal">Kos Yang Ditawarkan</h2>
     <p class="text-muted">
      Temukan kos yang sesuai dengan keinginan anda disini.
    </p>
    <div class="row mt-4" v-if="allKost && allKost.length > 0">
      <div class="col-lg-4" v-for="kost in allKost" :key="kost.id">
        <div class="card shadow-card bor-rad-top-10 mt-2 mb-2">
          <img class="card-img-top bor-rad-top-10 img-fit kost-img" 
            :src="storage + '/kosts/' + kost.image" 
            alt="Card image cap"
            >
          <div class="card-body">
            <h5 class="card-title font-weight-bold text-truncate">
              <a :href="home + '/detail-kos/' + kost.slug + '/' + kost.user_id" class="text-reset">
                {{kost.name}}
              </a>
            </h5>
            <p class="fs-16">
            Rp.{{formatNumber(kost.price)}}
              <small class="fs-14">/ bulan</small>
            </p>
            <p class="card-text fs-12 text-secondary text-truncate">
              <i class="fal fa-map-marker-alt"></i>
              {{kost.address}}
            </p>
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
                  <i class="far fa-star"></i>
                  {{kost.score ? parseFloat(kost.score).toFixed(1) : 0}}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
<div class="jumbo jumbotron-fluid" style="background-color: #021927;">
  <div class="text-center text-white container">
    <h3 class="text-white">Temukan tempat kos mu sekarang juga</h3>
    <a :href="home + '/list-kos'" type="button" class="mt-2 btn btn-outline-light rounded-pill">Lihat Selengkapnya</a>
  </div>
</div>
</div>
</template>

<script>
export default {
  props: ['home','storage'],
  data(){
    return{
      allKost: {},
      newestKost: {},
      search: ""
    }
  },
  methods:{
    getNewestKost() {
      axios.get('/all-kosts?limit=3&order_by=newest')
        .then(res => {
          this.newestKost = res.data
        })
    },
    getAllKost() {
      axios.get('/all-kosts?limit=6&order_by=random')
        .then(res => {
          this.allKost = res.data
        })
    },
    searchKost(){
      location.href = this.home + `/list-kos?q=${this.search}`
    },
    formatNumber(val) {
      return new Intl.NumberFormat(['ban', 'id']).format(val);
    }
  },
  mounted(){
    this.getAllKost()
    this.getNewestKost()
  }
}
</script>

<style>
.has-search .form-control {
  padding-left: 2.375rem;
}
.jumbo{
  padding: 4rem 1rem;
}
.overlay-bg-bottom {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #021927;
}
section {
    padding: 40px 15px;
}
.discover-text {
  width: 90%;
    margin: 0 auto;
    text-align: center;
    position: relative;
}
.overlay-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #021927;
    opacity: 0.9;
}
.discover-propt {
    background-image: url("https://images.pexels.com/photos/5849392/pexels-photo-5849392.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    padding: 80px 0 80px 0;
}
/* card */
.hov_pointer{
  cursor: pointer;
}
.img-fit {
  object-fit: cover !important;
}
.shadow-card {
    box-shadow: rgb(0 0 0 / 15%) 0px 2px 8px !important;
}
.bor-rad-10 {
  border-radius: 10px !important;
}
.bor-rad-top-10 {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
/* card */
/* font-size */
.fs-16 {
  font-size: 16px !important;
}
.fs-12 {
  font-size: 12px !important;
}
.fs-11{
  font-size: 11px !important;
}
/* font-size */
/* search */

.no-border{
    box-shadow: none !important;
}
.form-control::-webkit-input-placeholder{
    color: #949494;
    font-size: 14px;
    font-weight: 700;
}
.btn-search .form-control {
    padding-left: 2.375rem;
}
.btn-search-label{
  display: flex;
    width: 70px;
    height: 100%;
    font-size: 16px;
    font-weight: 700;
    line-height: 24px;
    color: #fff;
    background: #1baa56;
    border-radius: 4px;
    align-items: center;
    justify-content: center;
}
.form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #7f8c8d;
}

.fa-1-5{
      font-size: 1.5em;
}

.btn-search {
  position: relative;
    z-index: 1032;
    display: flex;
    width: 100%;
    height: 100%;
    padding: 4px;
    cursor: pointer;
    align-items: center;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 8px rgb(36 36 36 / 14%);
}
.btn-find-search{
  display: flex;
    flex: 1;
    height: 100%;
    justify-content: flex-end;
    align-items: center;
}
.search-container {
width: 400px;
height: 48px;
margin-top: 26px;
}
/* search */
.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}
.jumbotron {
background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("https://www.cekpremi.com/blog/wp-content/uploads/2021/04/bisnis-kos-kosan.jpeg");
height: 100%;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
position: relative;
height: 85vh;
}
.jumbotron:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.4;
}
</style>
