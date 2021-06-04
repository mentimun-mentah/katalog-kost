<template>
<div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <a :href="home + '/detail-kos/' + slug +'/'+ user_id">
        <img class="img-fit img-left" :src="storage + '/kosts/' + image" alt="kos">
      </a>                                       
    </div><!--/col-->
    <div class="col-md-8">
      <div class="d-flex flex-column h-100">
        <div class="text-dark card-body">
          <div class="text-dark font-weight-bold mb-1 hov_pointer card-title text-truncate h5">
            <a :href="home + '/detail-kos/' + slug +'/'+ user_id" class="text-reset">
              {{name}}
            </a>
          </div>
          <p class="fw-500 fs-16 text-dark mb-1">Rp.{{formatNumber(price)}}<small class="fs-14"> / bulan</small></p>
          <p class="fs-12 text-secondary card-text text-truncate"><i class="fal fa-map-marker-alt"></i> {{address}}</p>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="room">
            <i class="far fa-bed fa-lg mr-2"></i>
          </span>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="ac">
            <i class="far fa-air-conditioner fa-lg mr-2"></i>
          </span>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="wifi">
            <i class="far fa-wifi fa-lg mr-2"></i>
          </span>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="tv">
            <i class="far fa-tv fa-lg mr-2"></i>
          </span>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="parking">
            <i class="far fa-parking-circle fa-lg mr-2"></i>
          </span>
          <span class="font-weight-normal pl-0 mr-2 bd-right badge" v-if="wardrobe">
            <i class="far fa-cabinet-filing fa-lg mr-2"></i>
          </span>
        </div><!--/card-body-->
        <div class="card-footer bg-white text-muted">
          <div class="fs-12 row ">
            <div class="col"></i>Jumlah kamar: {{tRooms}}</div>
            <div class="text-right col">
              <span class="text-decoration-none text-muted">
                <i class="far fa-star"></i> {{score ? parseFloat(score).toFixed(1) : 0}}
              </span>
            </div>
          </div>
        </div><!--/card-body-->
      </div>
    </div><!--/col-->
    
  </div><!--/row-no-gutters-->

</div><!--/card-->
</template>

<script>
import isIn from 'validator/lib/isIn'
export default{
  props: ['price','name','image','address', 'tRooms',  'facilities', 'storage', 'home', 'slug', 'user_id', 'score'],
  data(){
    return {
      wifi: false,
      room: false,
      ac: false,
      parking: false,
      wardrobe: false,
      tv: false,
    }
  },
  methods: {
    kFormatter(num) {
      return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
    },
    formatNumber(val) {
      return new Intl.NumberFormat(['ban', 'id']).format(val);
    },
  },
  mounted(){
    let facilities_arr = this.facilities && this.facilities.length > 0 && this.facilities.split(',')
    if(isIn('wifi', facilities_arr)) this.wifi = true
    if(isIn('room', facilities_arr)) this.room = true
    if(isIn('ac', facilities_arr)) this.ac = true
    if(isIn('parking', facilities_arr)) this.parking = true
    if(isIn('wardrobe', facilities_arr)) this.wardrobe = true
    if(isIn('tv', facilities_arr)) this.tv = true
  },
}
</script>

<style>
/* Image left */
.img-left {
  object-fit: cover;
  width: 100%;
  height: 100%
}
/* Card Label */
.bd-rt {
    border-right: 1px solid #ddd;
    border-radius: 0px;
    margin-right: 0.4em;
}
.fs-12 {
    font-size: 12px;
}
.rate-info small {
  font-weight: 400;
}
.rate-info {
    float: left;
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 40px 23px 20px 23px;
    z-index: 2;
}
.rate-info:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(rgba(255, 255, 255, 0.02), rgba(44, 44, 47, 47));
    z-index: -1;
}
.cer span {
    color: #fff;
    text-transform: uppercase;
    font-size: 12px;
    background: rgba(145, 147, 152, 0.7);
    border-radius: 50px;
    padding: 5px 13px;
    float: right;
    /* margin-right: 24px; */
    margin-top: 2px;
}
.img-block {
    position: relative;
    z-index: 1;
    float: left;
    width: 100%;
}
.img-block h5, .map-box .rate-info > h5 {
    margin: 0px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    float: left;
    position: relative;
    top: 14px;
    right: 16px;
}
.card .img-block span, .map-box .rate-info > span {
    color: #fff;
    text-transform: uppercase;
    font-size: 12px;
    background: rgba(145, 147, 152, 0.7);
    border-radius: 50px;
    padding: 2px 8px;
    float: right;
    margin-top: 2px;
    position: relative;
    left: 18px;
    top: 12px;
}
.card .img-block span.for-sale, .map-box .rate-info > span.for-sale {
    background: #fc384a;
}
.card .img-block span.for-rent, .map-box .rate-info > span.for-rent {
    background: #1778F2;
}
@media only screen and (max-width: 1366px) {
.img-block h5, .map-box .rate-info > h5 {
    margin: 0px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    float: left;
    position: relative;
    top: 35px;
    right: 16px;
  }
}
</style>
