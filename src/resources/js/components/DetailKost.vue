<template>
<div>
  <Toasts></Toasts>
  <div class="container pt-5 text-truncate">
    <h1 class="property-title">{{kost.name}}</h1>
    <a href="#" target="_blank" class="text-decoration-none text-secondary ft-14 text-truncate">
      <i class="fal fa-map-marker-alt"></i>
      <span><u>{{kost.address}}</u></span>
    </a>
  </div>

  <section class="px-0 py-3">
    <div class="container">

      <div id="cardImageCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div 
            class="carousel-item" v-for="(img, i) in kost.image.split(',')" :key="i"
            :class="[i == 0 ? 'active' : '']"
            >

            <div class="image-left-radius big-img-desktop">
              <div class="smooth-image-wrapper">
                <img :src="storage + '/kosts/' + img" alt="kos" class="smooth-image img-visible img-fluid" style="object-fit: cover;">
              </div>
            </div>

          </div>

        </div>
        <a class="carousel-control-prev" href="#cardImageCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#cardImageCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>
  </section>

  <div class="container">
  <div class="row property">
    <div class="col-8">
      <div class="property-content">


        <div class="card mt-5 shadow-sm">
          <div class="card-body property-description mb-2">
            <h3 class="card-title property-content-title">Deskripsi Kos</h3>
            <p class="card-text text-justify mt-4">
              {{kost.desc}}
            </p>
            
          </div>
        </div>

        <div class="card mt-5 shadow-sm">
          <div class="card-body property-amenities">
            <h3 class="card-title">Fasilitas</h3>
            <ul class="pt-2">
              <li v-if="kost.facilities.indexOf('room') !== -1">
                <i class="far fa-bed"></i>
                <label>
                  &nbsp;
                  Kasur
                </label>
              </li>
              <li v-if="kost.facilities.indexOf('ac') !== -1">
                <i class="far fa-air-conditioner"></i>
                <label>
                  &nbsp;
                  Air conditioning
                </label>
              </li>
              <li v-if="kost.facilities.indexOf('wifi') !== -1">
                <i class="far fa-wifi"></i>
                <label>
                  &nbsp;
                  Wifi
                </label>
              </li>
              <li v-if="kost.facilities.indexOf('tv') !== -1">
                <i class="far fa-tv"></i>
                <label>
                  &nbsp;
                  TV
                </label>
              </li>
              <li v-if="kost.facilities.indexOf('parking') !== -1">
                <i class="far fa-parking-circle"></i>
                <label>
                  &nbsp;
                  Free street parking
                </label>
              </li>
              <li v-if="kost.facilities.indexOf('wardrobe') !== -1">
                <i class="fal fa-cabinet-filing"></i>
                <label>
                  &nbsp;
                  Lemari Pakaian
                </label>
              </li>
            </ul>
          </div>
        </div>

        <!--The div element for the map -->
        <div class="card mt-3 border-0">
          <div class="card-body">
            <h3 class="card-title">Lokasi Kos</h3>
            <!--The div element for the map -->

            <gmap-map
              :options="{
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: true,
                rotateControl: false,
                fullscreenControl: true,
                disableDefaultUi: false,
                zoomControlOptions: {position: 1},
                streetViewControlOptions: {position: 5}
              }"
              :zoom="16"
              :center="{lat: kost.lat, lng: kost.lng}"
              map-type-id="roadmap"
              style="width: 100%; height: 450px"
            >
              <gmap-marker
                :key="index"
                v-for="(m, index) in [{lat: kost.lat, lng: kost.lng}]"
                :position="m"
                :icon="markerOptions"
              ></gmap-marker>
            </gmap-map>
          </div>
        </div>

        <!-- comment -->
        <div class="row">
          <div class="col-lg-10">
            <section class="pb-0">
              <div class="row">
                <div class="col pl-0">
                  <div class="card border-0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <h2 class="font-size-review mb-4">ULASAN({{rating[0] && rating[0].score_count}})</h2>
                          <h5 class="fs-60 ml-2">
                            {{rating[0] && rating[0].score_value ? parseFloat(rating[0].score_value).toFixed(1) : parseFloat(0).toFixed(1) }}<small class="ml-2 fs-16 text-muted">/5</small>
                          </h5>
                          <div class="ml-2">
                            <star-rating v-bind:increment="0.5"
                             v-bind:max-rating="5"
                             active-color="#ffc400"
                             :rating="4.1"
                             :inline="true"
                             v-bind:star-size="20"
                             v-model="rating[0] && rating[0].score_value && +parseFloat(rating[0].score_value).toFixed(1)"
                             :show-rating="false"
                             :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
                             >
                            </star-rating>
                              <p class="mt-2 ml-2 fr-review text-muted">({{rating[0] && rating[0].score_count}}) Ulasan</p>
                          </div>
                        </div>
                        <div class="col-md-1 mt-2">
                          <div class="row">
                            <h6 class="rating_text"> <i class="fas fa-star rating-color mr-2"></i> 5 </h6>
                          </div>
                          <div class="row">
                            <h6> <i class="fas fa-star rating-color mr-2"></i> 4 </h6>
                          </div>
                          <div class="row">
                            <h6> <i class="fas fa-star rating-color mr-2"></i> 3 </h6>
                          </div>
                          <div class="row">
                            <h6> <i class="fas fa-star rating-color mr-2"></i> 2 </h6>
                          </div>
                          <div class="row">
                            <h6> <i class="fas fa-star rating-color mr-2"></i> 1 </h6>
                          </div>
                        </div>
                        <div class="col-md-7 pl-0">
                          <div class="progress mt-5 progress-h">
                            <div class="progress-bar green" style="height:10px" :style="{ width: progressBar[4] +'%'}"></div>
                          </div>
                          <div class="progress mt-20 progress-h">
                            <div class="progress-bar green" style="height:10px" :style="{ width: progressBar[3] +'%'}"></div>
                          </div>
                          <div class="progress mt-20 progress-h">
                            <div class="progress-bar green" style="height:10px" :style="{ width: progressBar[2] +'%'}"></div>
                          </div>
                          <div class="progress mt-20 progress-h">
                            <div class="progress-bar green" style="height:10px" :style="{ width: progressBar[1] +'%'}"></div>
                          </div>
                          <div class="progress mt-20 progress-h">
                            <div class="progress-bar green" style="height:10px" :style="{ width: progressBar[0] +'%'}"></div>
                          </div>                
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <section>
              <h2 class="font-size-review">{{kost.name}}</h2>
              <h2 class="fr-review text-muted mb-4">Bagaimana kualitas kos ini secara keseluruhan ?</h2>
              <div class="mb-5">
                <star-rating
                 v-bind:max-rating="5"
                 active-color="#ffc400"
                 :inline="true"
                 v-bind:star-size="20"
                 :show-rating="false"
                 v-model="add_rating.rating"
                 >
                </star-rating>
                <br/>
                <small class="text-danger" v-if="errors.rating">
                  {{ errors.rating[0] }}
                </small>
                <p class="mt-4 fr-review text-muted">Berikan ulasan untuk unit ini</p>
                <div class="form-group w-comment mt-4">
                  <wysiwyg v-model="add_rating.review"/>
                  <small class="text-danger" v-if="errors.review">
                    {{ errors.review[0] }}
                  </small>
                </div>
                <button
                  type="button"
                  class="btn btn-outline-green mb-3 btn-block w-comment" @click="addRating">
                  <i class="fal fa-paper-plane mr-1"></i>
                  Kirim Komentar
                </button>
              </div>

              <div v-if="ratingUsers && ratingUsers.data && ratingUsers.data.length > 0">
                <div class="related-topic-card w-126" v-for="(rating, index) in ratingUsers.data" :key="index">
                  <a class="text-reset text-decoration-none">
                    <div class="topic-container">
                      <img
                        class="mr-1 img rounded-circle"
                        :src="storage + '/avatar/' + rating.users_avatar"
                        alt="Generic placeholder image"
                      />
                      <div class="topic-title">
                        <span class="card-title text-decoration-none text-dark truncate-2">
                          {{rating.users_name}}
                          <span class="text-muted mx-2">•</span>
                          <span class="text-secondary">{{momentDate(rating.ratings_created_at)}}</span>
                        </span>
                        <div class="topic-by text-secondary">
                          <star-rating
                           v-bind:max-rating="5"
                           active-color="#ffc400"
                           :inline="true"
                           v-bind:star-size="15"
                           :show-rating="false"
                           :rating="3.8"
                           :read-only="true"
                           v-model="rating.ratings_rating"
                           >
                          </star-rating>
                        </div>
                      </div><!--topic-title-->
                    </div><!--/topic-container-->
                    <div class="topic-detail">
                      <p class="mb-0 truncate-2">
                      {{rating.ratings_review}}
                      </p>
                    </div>
                    <!-- /topic-detail -->
                  </a>
                </div>
                <!-- /related-topic-card -->
              </div><!--/v-if-->

              <pagination
                :data="ratingUsers"
                :limit="2"
                class="mt-5"
                :align="'center'"
                @pagination-change-page="getRating"
              ></pagination>

            </section>
          </div>
          <!-- /col-lg-8 -->
        </div><!--/row-->
      </div>
    </div>

    <div class="col-4">
      <div class="card property-inquiry text-center rounded-inquiry shadow mt-5 border-0">
        <div class="card-body">
          <h5 class="card-title mt-0 fs-16 mb-0 pb-1" v-if="kost.price_day">
            Rp.{{formatNumber(kost.price_day)}} / hari
          </h5>
          <h5 class="card-title mt-0 fs-16 mb-0 pb-1" v-if="kost.price_month">
            Rp.{{formatNumber(kost.price_month)}} / bulan
          </h5>
          <h5 class="card-title mt-0 fs-16 mb-0 pb-1" v-if="kost.price_year">
            Rp.{{formatNumber(kost.price_year)}} / tahun
          </h5>
          <hr>
          <h4 class="fs-14 text-left">
            Kategori:
            <span class="font-weight-normal ml-1 text-capitalize">{{kost.category}}</span>
          </h4>
          <h4 class="fs-14 text-left">
            Jumlah Kamar:
            <span class="font-weight-normal ml-1">{{kost.total_rooms}}</span>
          </h4>
        </div>
        <div class="card-footer bg-transparent border-top-0">
          <h4 class="fs-18 text-center text-capitalize">{{kost.user.name}}</h4>
          <a :href="'https://wa.me/' + kost.user.phone" target="_blank" class="btn btn-lg bg-call btn-block">
            <i class="fal fa-phone-alt mr-2"></i>
            <span>
              Hubungi Pemilik
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>

import {gmapApi} from 'vue2-google-maps'
import moment from 'moment'
import StarRating from 'vue-star-rating'

export default{
  props: ['home', 'kost','storage'],
  data() {
    return {
      ratingUsers: {},
      rating: [],
      progressBar: [],
      add_rating: {
        rating: 0,
        review: ""
      },
      errors: [],
      center: {lat: -8.811012, lng: 115.173601},
      markers: [
        {
          lat: -8.811012, lng: 115.173601,
          label: 'Surat'
        },
      ],
      markerOptions: {
        url: this.storage + '/marker.svg',
        scaledSize: {width: 45, height: 45, f: 'px', b: 'px'},
      },
    }
  },
  methods: {
    addRating(){
      let data = {
        rating: this.add_rating.rating,
        review: this.add_rating.review,
        kost_id: this.kost.id
      } 

      axios.post('/rating/create-rating',data).then(res => {
        this.$toast.success(res.data.status);
        this.errors = [];
        this.add_rating.rating = 0
        this.add_rating.review = ""
        this.getRating()
        this.getTotalRating()
      }).catch(err => {
        if(err.response.status === 401) {
          location.replace(this.home + '/login')
        }
        this.errors = err.response.data.errors;
      })
    },
    getRating(page = 1){
      axios.get(`/rating/get-rating/${this.kost.id}?page=${page}`)
        .then(res => {
          this.ratingUsers = res.data
        })
    },
    getTotalRating(){
      axios.get(`/rating/get-total-rating/${this.kost.id}`)
        .then(res => {
          this.rating = res.data
          let tot = res.data[0].score_count
          let p1 = res.data[0].score_one_count * 100 / tot
          let p2 = res.data[0].score_two_count * 100 / tot
          let p3 = res.data[0].score_three_count * 100 / tot
          let p4 = res.data[0].score_four_count * 100 / tot
          let p5 = res.data[0].score_five_count * 100 / tot
          this.progressBar = [p1,p2,p3,p4,p5]
        })
    },
    formatNumber(val) {
      return new Intl.NumberFormat(['ban', 'id']).format(val);
    },
    momentDate(val) {
      moment.locale('id')
      return moment(val).format('lll')
    },
  },
  computed: {
    google: gmapApi
  },
  components: {
    StarRating
  },
  mounted() {
    this.getRating()
    this.getTotalRating()
  }
}

</script>
<style>
/* title property */
.w-comment {
  width:126%;
}
.desc-text {
    color: #242526;
    font-size: 14px;
    display: inline-block;
}
.fs-18 {
    font-size: 18px !important;
}
.fs-14 {
    font-size: 14px !important;
}
.img-fit {
  object-fit: cover;
}
/* image  detail*/
.small-img-desktop .smooth-image {
    height: 181px !important;
}
.image-left-radius > .smooth-image-wrapper img {
    border-radius: 15px 15px 15px 15px;
}
.row-ml-9px {
    margin-left: -9px;
}
.smooth-image-wrapper {
    position: relative;
}
.smooth-image-wrapper .smooth-image {
    transition: opacity 1s;
}
.smooth-image-wrapper .img-visible {
    opacity: 1;
}
.big-img-desktop .smooth-image {
    height: 600px !important;
    width: 100%;
}
/* Fasilitas Detail*/
.property-amenities {
    padding: 10px 30px 10px 30px;
} 
.property-amenities ul li {
    float: left;
    width: 33%;
    margin-bottom: 15px;
    list-style: none;
}
/* Agent */
.bg-call {
  background-color: #38c172;
  color: white;
  border: 2px solid white;
}
.bg-call:hover {
  color: white;
}
.bg-call:focus {
  color: white;
}
.avatar {
  vertical-align: middle;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 2px solid white;
}
.rounded-inquiry {
  border-radius: 10px;
}
.property-inquiry {
  position: sticky;
  top: 2%;
}

.editr {
  border-radius: 0.25rem;
  border: 1px solid #e4e4e4;
  width: 100%;
}
.editr--toolbar {
  background: #f6f6f6;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
  border-bottom: 1px solid #e4e4e4;
  position: relative;
  display: flex;
  height: 32px;
}
.editr--toolbar a {
  display: inline-block;
  width: 8vw;
  max-width: 32px;
  height: 32px;
  color: #333;
  fill: #333;
  cursor: pointer;
  text-align: center;
  line-height: 1;
}
.editr--toolbar a:hover {
  background: rgba(0, 0, 0, 0.1);
}
.editr--toolbar a:active {
  background: rgba(0, 0, 0, 0.2);
}
.editr--toolbar a svg {
  width: 16px;
  height: 16px;
  margin: 8px auto;
}
.editr--toolbar a svg path {
  fill: inherit;
}
.editr--toolbar a.vw-btn-separator {
  width: 1px;
  margin: 0 8px;
}
.editr--toolbar a.vw-btn-separator:hover {
  background: initial;
  cursor: default;
}
.editr--toolbar a.vw-btn-separator i.vw-separator {
  border-left: 1px solid rgba(0, 0, 0, 0.1);
  height: 100%;
  position: absolute;
  width: 1px;
}
.editr--toolbar .dashboard {
  width: 100%;
  position: absolute;
  top: 32px;
  left: 0;
  text-align: left;
  padding: 8px 16px;
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid #f6f6f6;
}
.editr--content {
  min-height: 150px;
  padding: 12px 8px 16px 8px;
  line-height: 1.33;
  font-family: inherit;
  color: inherit;
  overflow-y: auto;
  background: rgba(255, 255, 255, 0.95);
  border-bottom-left-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}
.editr--content[contenteditable="true"]:empty:before {
  content: attr(placeholder);
  color: rgba(0, 0, 0, 0.3);
  display: block; /* For Firefox */
}
.editr--content img {
  max-width: 100%;
}
.editr--content table {
  width: 100%;
  border-collapse: collapse;
}
.editr--content table th {
  text-align: left;
}
.editr--content table th,
.editr--content table td {
  border: 1px solid #ddd;
  padding: 2px;
}
.editr--content:focus {
  outline: 0;
}
.editr--content ul li,
.editr--content ol li {
  list-style-position: inside;
}
@media screen and (max-width: 320px) {
  .editr--toolbar a {
    margin: 0 2px;
  }
  .editr--toolbar a.vw-btn-separator {
    display: none;
  }
}
/* Review */
.rating_circle{
   width: 120px;
   height: 120px;
   border-radius: 70px;
   border: 1px none;
   background-color: #ffffff00;
 }
 .rating_text{
     margin-top: 35px;
 }
 .stars-outer {
 display: inline-block;
 position: relative;
 font-family: FontAwesome;
 font-size: 20px;
 letter-spacing: 5px;
}

.stars-outer::before {
  content: "\f006 \f006 \f006 \f006 \f006";
}

.stars-inner {
  position: absolute;
  top: 0;
  left: 0;
  white-space: nowrap;
  overflow: hidden;
  width: 0;
}

.stars-inner::before {
content: "\f005 \f005 \f005 \f005 \f005";
color: #000000;
}
.green {
  background-color: #03ac0e;
}
.c-green{
  color: #03ac0e;
}
.fs-60{
  font-size: 60px;
}
.progress-h {
  height: 5px;
}
.mt-20 {
  margin-top: 20px !important;
}
.rating-color {
  color: #ffc400;
}
.btn-outline-green {
    color: #03ac0e;
    border-color: #03ac0e;
}
.font-size-review{
  font-size: 1.14286rem;
}
.fr-review{
  font-weight: 400;
  font-size: 0.857143rem;
  color: var(--color-text-low,rgba(49,53,59,0.68));
}
.title-review{
  font-size: 1rem;
  font-weight: 400;
  text-transform: none;
  margin-top: 10px;
  line-height: 22px;
}
/* comment display */
.img {
  width: 50px;
  height: 50px;
  object-fit: cover;
}
.w-126 {
  width: 126%;
}
.related-topic-card {
  padding: 20px 0 17px;
  border-bottom: solid 1px #e0e0e0;
}
.topic-info {
  float: right;
  text-align: right;
  font-size: 14px;
}
.topic-container {
  margin-bottom: 16px;
  display: inline-flex;
}
.topic-detail {
  width: 714px;
  overflow-wrap: break-word;
}
.topic-title {
  display: inline-block;
  width: 350px;
  vertical-align: top;
  margin-left: 16px;
}

</style>
