<template>
  <div>
    <Toasts></Toasts>
    <div class="card-container card">
      <div class="bg-transparent border-bottom card-header">
        <h5 class="mt-1 mb-0 font-weight-bold">Tambah Kos</h5>
      </div>
      <!--/card-header-->
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group">
                <label>Foto Kos</label>
                <div class="row">

                  <div class="col" v-for="i in 3" :key="i - 1">
                    <img
                      id="image-preview"
                      class="card-img-top img-fit upload-img p-t-4 p-r-4 p-b-4 p-l-4 border"
                      alt="Card image cap"
                      :src="
                          url_image[i - 1]
                              ? url_image[i - 1]
                              : 'https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png'
                      "
                    />
                    <div class="w-100 text-center">
                      <div class="file-btn btn btn-sm button border mt-2">
                        Upload
                        <input
                          type="file"
                          class="fileupload"
                          name="file[]"
                          accept="image/*"
                          @change="(e) => changeKost(e, i - 1)"
                        />
                      </div>
                    </div><!--/w-100-->
                    <small class="text-danger" v-if="errors && errors[`images.${i-1}`]" style="white-space: nowrap;">
                      {{errors && errors[`images.${i-1}`][0]}}
                    </small>

                  </div><!--/col-->
                  
                </div><!--/row-->
                <small class="text-danger" v-if="errors && errors.images" style="white-space: nowrap;">
                  {{errors && errors.images && errors.images[0]}}
                </small>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label>Nama Kos</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Nama Kos"
                    v-model="add_kost.name"
                />
                <small class="text-danger" v-if="errors.name">
                  {{ errors.name[0] }}
                </small>
              </div>

              <div class="form-group col-md-6 col-sm-6">
                <label>Kategori</label>
                <select class="form-control" v-model="add_kost.category">
                    <option disabled value=""
                        >Please select one</option
                    >
                    <option value="umum">Umum</option>
                    <option value="perempuan">Perempuan</option>
                    <option value="laki-laki">Laki-laki</option>
                </select>
                <small class="text-danger" v-if="errors.category">
                  {{ errors.category[0] }}
                </small>
              </div>

              <div class="form-group col-md-6 col-sm-6">
                <label>Jumlah Kamar</label>
                <input
                  type="number"
                  class="form-control"
                  placeholder="Jumlah Kamar"
                  v-model="add_kost.total_rooms"
                />
                <small class="text-danger" v-if="errors.total_rooms">
                  {{ errors.total_rooms[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Harga Kos <small>/hari</small></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Harga Kos"
                    v-model="add_kost.price_day"
                  />
                </div>
                <small class="text-danger" v-if="errors.price_day">
                  {{ errors.price_day[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Harga Kos <small>/bulan</small></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Harga Kos"
                    v-model="add_kost.price_month"
                  />
                </div>
                <small class="text-danger" v-if="errors.price_month">
                  {{ errors.price_month[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Harga Kos <small>/tahun</small></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Harga Kos"
                    v-model="add_kost.price_year"
                  />
                </div>
                <small class="text-danger" v-if="errors.price_year">
                  {{ errors.price_year[0] }}
                </small>
              </div>

              <div class="form-group col-md-12">
                <label for="inputEmail4">Fasilitas</label>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="wifi" v-model="wifi">
                  <label class="form-check-label" for="inlineCheckbox1">
                    <i class="fal fa-wifi"></i>
                    Wifi
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="room" v-model="room">
                  <label class="form-check-label" for="inlineCheckbox2">
                    <i class="fal fa-bed"></i>
                    Kamar
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="ac" v-model="ac">
                  <label class="form-check-label" for="inlineCheckbox3">
                    <i class="fal fa-air-conditioner"></i>
                    Pendingin Ruangan
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="parking" v-model="parking">
                  <label class="form-check-label" for="inlineCheckbox4">
                    <i class="fal fa-parking-circle"></i>
                    Bebas Parkir
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="wardrobe" v-model="wardrobe">
                  <label class="form-check-label" for="inlineCheckbox5">
                    <i class="fal fa-cabinet-filing"></i>
                    Lemari
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="tv" v-model="tv">
                  <label class="form-check-label" for="inlineCheckbox6">
                    <i class="fal fa-tv"></i>
                    TV
                  </label>
                </div>
                <br />
                <small class="text-danger" v-if="errors.facilities">
                  {{ errors.facilities[0] }}
                </small>
              </div>

              <div class="form-row col-12">
                <div class="form-group col-6">
                  <label>Latitude</label>
                  <i class="fal fa-info-circle hover-pointer" data-toggle="modal" data-target="#exampleModal"></i>
                  <input type="text" class="form-control" placeholder="Latitude" v-model="add_kost.lat">
                  <small class="text-danger" v-if="errors.lat">
                    {{ errors.lat[0] }}
                  </small>
                </div>
                <div class="form-group col-6">
                  <label>Longitude</label>
                  <i class="fal fa-info-circle hover-pointer" data-toggle="modal" data-target="#exampleModal"></i>
                  <input type="text" class="form-control" placeholder="Longitude" v-model="add_kost.lng">
                  <small class="text-danger" v-if="errors.lng">
                    {{ errors.lng[0] }}
                  </small>
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="inputEmail5">Alamat</label>
                <textarea
                  class="form-control"
                  placeholder="Alamat"
                  rows="2"
                  v-model="add_kost.address"
                ></textarea>
                <small class="text-danger" v-if="errors.address">
                  {{ errors.address[0] }}
                </small>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label>Deskripsi</label>
                <textarea
                  class="form-control"
                  placeholder="Deskripsi"
                  rows="3"
                  v-model="add_kost.desc"
                ></textarea>
                <small class="text-danger" v-if="errors.desc">
                  {{ errors.desc[0] }}
                </small>
              </div>

            </div>
            <!--/form-row-->

            <button 
              class="btn btn-green float-right mb-3" 
              @click="addKost"
              :disabled="saveDisabled"
            >
              Simpan
            </button>
          </div>
          <!--/card-body-->
        </div>
        <!--/col-->
      </div>
      <!--/row-->
    </div>
    <!--/card-container-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cara mendapatkan Latitude dan Longitude</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ol>
              <li>Masuk ke halaman <a href="https://www.latlong.net/" target="_blank">www.latlong.net</a></li>
              <li>Masukkan tempat yang ingin dicari.</li>
              <li>Salin dan tempel latitude longitude pada form yang telah disediakan.</li>
            </ol>
          </div>
        </div>
      </div>
    </div><!--/modal-->
  </div>
</template>

<script>
import _ from 'lodash'

export default {
  data() {
    return {
      saveDisabled: true,
      url_image: [],
      wifi: false,
      room: false,
      ac: false,
      parking: false,
      wardrobe: false,
      tv: false,
      add_kost: {
        image: [],
        name: "",
        category: "",
        total_rooms: 0,
        price_day: 0,
        price_month: 0,
        price_year: 0,
        facilities: [],
        lat: "",
        lng: "",
        address: "",
        desc: ""
      },
      errors: [],
    }
  },
  methods:{
    insertAt(arr, index, elements) {
      arr.splice(index, 1)
      arr.splice(index, 0, elements)
      return arr
    },
    changeKost(e, i){
      this.add_kost.image = this.insertAt(this.add_kost.image, i, e.target.files[0])
      this.url_image = this.insertAt(this.url_image, i, URL.createObjectURL(e.target.files[0]))
    },
    addKost(){
      let formData = new FormData();
      this.add_kost.image.forEach((img,i) => {
        formData.append("images[]", img)
      })
      formData.append("name", this.add_kost.name)
      formData.append("category", this.add_kost.category)
      formData.append("total_rooms", this.add_kost.total_rooms)
      formData.append("facilities", this.add_kost.facilities.join(','))
      formData.append("lat", this.add_kost.lat)
      formData.append("lng", this.add_kost.lng)
      formData.append("address", this.add_kost.address)
      formData.append("desc", this.add_kost.desc)

      if(this.add_kost.price_day > 0) formData.append("price_day", this.add_kost.price_day)
      if(this.add_kost.price_month > 0) formData.append("price_month", this.add_kost.price_month)
      if(this.add_kost.price_year > 0) formData.append("price_year", this.add_kost.price_year)

      const config = {
          headers: { "content-type": "multipart/form-data" }
      };

      axios.post('/kosts/create-kost',formData,config).then(res => {
        this.$toast.success(res.data.status);
        this.errors = [];
        this.url_image = []
        this.add_kost.image = []
        this.add_kost.name = ""
        this.add_kost.category = ""
        this.add_kost.total_rooms = 0
        this.add_kost.price_day = 0
        this.add_kost.price_month = 0
        this.add_kost.price_year = 0
        this.add_kost.facilities = []
        this.add_kost.lat = ""
        this.add_kost.lng = ""
        this.add_kost.address = ""
        this.add_kost.desc = ""
        this.wifi = false
        this.room = false
        this.ac = false
        this.parking = false
        this.wardrobe = false
        this.tv = false
      }).catch(err => {
        console.log(err.response)
        this.errors = err.response.data.errors;
      })
    },
  },
  watch: {
    'add_kost.price_day'(val){
      if(val > 0) this.saveDisabled = false;
      else this.saveDisabled = true;
    },
    'add_kost.price_month'(val){
      if(val > 0) this.saveDisabled = false;
      else this.saveDisabled = true;
    },
    'add_kost.price_year'(val){
      if(val > 0) this.saveDisabled = false;
      else this.saveDisabled = true;
    },
    wifi(val){
      if(val) this.add_kost.facilities.push('wifi')
      else {
        let idx = this.add_kost.facilities.indexOf('wifi')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
    room(val){
      if(val) this.add_kost.facilities.push('room')
      else {
        let idx = this.add_kost.facilities.indexOf('room')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
    ac(val){
      if(val) this.add_kost.facilities.push('ac')
      else {
        let idx = this.add_kost.facilities.indexOf('ac')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
    parking(val){
      if(val) this.add_kost.facilities.push('parking')
      else {
        let idx = this.add_kost.facilities.indexOf('parking')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
    wardrobe(val){
      if(val) this.add_kost.facilities.push('wardrobe')
      else {
        let idx = this.add_kost.facilities.indexOf('wardrobe')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
    tv(val){
      if(val) this.add_kost.facilities.push('tv')
      else {
        let idx = this.add_kost.facilities.indexOf('tv')
        if(idx !== -1){
          this.add_kost.facilities.splice(idx, 1)
        }
      }
    },
  }
}
</script>

<style>
.file-btn {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    text-align: center;
    margin: 0 auto;
}
.fileupload {
    cursor: pointer;
    position: absolute;
    font-size: 50px;
    opacity: 0;
    right: 0;
    top: 0;
}
</style>
