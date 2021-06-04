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
              <div class="form-group col-md-2 col-sm-8">
                <label>Foto Kos</label>
                <img
                  id="image-preview"
                  class="card-img-top img-fit upload-img p-t-4 p-r-4 p-b-4 p-l-4 border"
                  alt="Card image cap"
                  :src="
                      url_image
                          ? url_image
                          : storage + '/' + update_kost.image
                  "
                />
                <div
                    class="file-btn btn btn-sm button border mt-2"
                >
                  Upload
                  <input
                      type="file"
                      class="fileupload"
                      name="file"
                      accept="image/*"
                      @change="changeKost"
                  />
                </div>
                <small class="text-danger" v-if="errors.image" style="white-space: nowrap;">
                  {{ errors.image[0] }}
                </small>
              </div>

              <div class="form-group col-md-12 col-sm-12">
                <label>Nama Kos</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Nama Kos"
                    v-model="update_kost.name"
                />
                <small class="text-danger" v-if="errors.name">
                  {{ errors.name[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Kategori</label>
                <select class="form-control" v-model="update_kost.category">
                    <option disabled value=""
                        >Please select one</option
                    >
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="umum">Umum</option>
                </select>
                <small class="text-danger" v-if="errors.category">
                  {{ errors.category[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Jumlah Kamar</label>
                <input
                    type="number"
                    class="form-control"
                    placeholder="Jumlah Kamar"
                    v-model="update_kost.total_rooms"
                />
                <small class="text-danger" v-if="errors.total_rooms">
                  {{ errors.total_rooms[0] }}
                </small>
              </div>

              <div class="form-group col-md-4 col-sm-4">
                <label>Harga Kos <small>/bulan</small></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span
                        class="input-group-text"
                        id="basic-addon1"
                        >Rp</span
                    >
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Harga Kos"
                    v-model="update_kost.price"
                  />
                </div>
                <small class="text-danger" v-if="errors.price">
                  {{ errors.price[0] }}
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
                  <input type="text" class="form-control" placeholder="Latitude" v-model="update_kost.lat">
                  <small class="text-danger" v-if="errors.lat">
                    {{ errors.lat[0] }}
                  </small>
                </div>
                <div class="form-group col-6">
                  <label>Longitude</label>
                  <i class="fal fa-info-circle hover-pointer" data-toggle="modal" data-target="#exampleModal"></i>
                  <input type="text" class="form-control" placeholder="Longitude" v-model="update_kost.lng">
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
                    v-model="update_kost.address"
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
                    v-model="update_kost.desc"
                ></textarea>
                <small class="text-danger" v-if="errors.desc">
                  {{ errors.desc[0] }}
                </small>
              </div>

            </div>
            <!--/form-row-->

            <button class="btn btn-green float-right mb-3" @click="updateKost">
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
import isIn from 'validator/lib/isIn'
export default{
  props: ['kost','storage'],
  data(){
    return{
      url_image: null,
      wifi: false,
      room: false,
      ac: false,
      parking: false,
      wardrobe: false,
      tv: false,
      update_kost: {
        image: null,
        name: "",
        category: "",
        total_rooms: 0,
        price: 0,
        facilities: [],
        lat: "",
        lng: "",
        address: "",
        desc: ""
      },
      errors: []
    }
  },
  methods:{
    changeKost(e){
      this.update_kost.image = e.target.files[0];
      this.url_image = URL.createObjectURL(this.update_kost.image);
    },
    updateKost(){
      let formData = new FormData();
      if(typeof this.update_kost.image !== 'string') formData.append("image", this.update_kost.image);

      formData.append("id", this.kost.id)
      formData.append("name", this.update_kost.name)
      formData.append("category", this.update_kost.category)
      formData.append("total_rooms", this.update_kost.total_rooms)
      formData.append("price", this.update_kost.price)
      formData.append("facilities", this.update_kost.facilities.join(','))
      formData.append("lat", this.update_kost.lat)
      formData.append("lng", this.update_kost.lng)
      formData.append("address", this.update_kost.address)
      formData.append("desc", this.update_kost.desc)
      const config = {
          headers: { "content-type": "multipart/form-data" }
      };

      axios.post('/kosts/update-kost',formData,config).then(res => {
          location.reload();
      }).catch(err => {
          this.errors = err.response.data.errors;
      })

    }
  },
  mounted(){
    this.update_kost.image = this.kost.image
    this.update_kost.name = this.kost.name
    this.update_kost.category = this.kost.category
    this.update_kost.total_rooms = this.kost.total_rooms
    this.update_kost.price = this.kost.price
    this.update_kost.lat = this.kost.lat
    this.update_kost.lng = this.kost.lng
    this.update_kost.address = this.kost.address
    this.update_kost.desc = this.kost.desc
    this.update_kost.facilities = this.kost.facilities.split(',')

    let facilities_arr = this.kost.facilities.split(',')
    if(isIn('wifi', facilities_arr)) this.wifi = true
    if(isIn('room', facilities_arr)) this.room = true
    if(isIn('ac', facilities_arr)) this.ac = true
    if(isIn('parking', facilities_arr)) this.parking = true
    if(isIn('wardrobe', facilities_arr)) this.wardrobe = true
    if(isIn('tv', facilities_arr)) this.tv = true
  },
  watch: {
    wifi(val){
      if(val) this.update_kost.facilities.push('wifi')
      else {
        let idx = this.update_kost.facilities.indexOf('wifi')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
        }
      }
    },
    room(val){
      if(val) this.update_kost.facilities.push('room')
      else {
        let idx = this.update_kost.facilities.indexOf('room')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
        }
      }
    },
    ac(val){
      if(val) this.update_kost.facilities.push('ac')
      else {
        let idx = this.update_kost.facilities.indexOf('ac')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
        }
      }
    },
    parking(val){
      if(val) this.update_kost.facilities.push('parking')
      else {
        let idx = this.update_kost.facilities.indexOf('parking')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
        }
      }
    },
    wardrobe(val){
      if(val) this.update_kost.facilities.push('wardrobe')
      else {
        let idx = this.update_kost.facilities.indexOf('wardrobe')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
        }
      }
    },
    tv(val){
      if(val) this.update_kost.facilities.push('tv')
      else {
        let idx = this.update_kost.facilities.indexOf('tv')
        if(idx !== -1){
          this.update_kost.facilities.splice(idx, 1)
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
    left: 21%;
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
