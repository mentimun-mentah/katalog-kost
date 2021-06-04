<template>
  <div class="bg-white">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a
                class="nav-link active"
                id="nav-home-tab"
                data-toggle="tab"
                href="#nav-home"
                role="tab"
                aria-controls="nav-home"
                aria-selected="true"
              >
                Pengguna
              </a>
              <a
                class="nav-link"
                id="nav-profile-tab"
                data-toggle="tab"
                href="#nav-profile"
                role="tab"
                aria-controls="nav-profile"
                aria-selected="false"
              >
                Pemilik Kos
              </a>
            </div>
          </nav>

          <div class="tab-content" id="nav-tabContent">
            <div
              class="tab-pane fade show active"
              id="nav-home"
              role="tabpanel"
              aria-labelledby="nav-home-tab"
            >
              <div class="card">
                <div class="card-body">
                  <div class="form-group row">
                    <label
                      for="name"
                      class="col-md-4 col-form-label text-md-right"
                      >Username</label
                    >
                    <div class="col-md-6">
                      <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autofocus
                        v-model="register_pengguna.name"
                        :class="[errors.name ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors.name">
                        {{ errors.name[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="email"
                      class="col-md-4 col-form-label text-md-right"
                      >E-Mail Address</label
                    >
                    <div class="col-md-6">
                      <input
                        id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        required
                        v-model="register_pengguna.email"
                        :class="[errors.email ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors.email">
                        {{ errors.email[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="password"
                      class="col-md-4 col-form-label text-md-right"
                      >Password</label
                    >
                    <div class="col-md-6">
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        required
                        v-model="register_pengguna.password"
                        :class="[errors.password ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors.password">
                        {{ errors.password[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="confirm_password"
                      class="col-md-4 col-form-label text-md-right"
                      >Confirm Password</label
                    >
                    <div class="col-md-6">
                      <input
                        id="confirm_password"
                        type="password"
                        class="form-control"
                        name="confirm_password"
                        required
                        v-model="register_pengguna.password_confirmation"
                      />
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button
                        type="submit"
                        class="btn btn-primary"
                        @click="registerPengguna"
                      >
                        Register
                      </button>
                    </div>
                  </div>
                </div>
                <!-- /card-body -->
              </div>
              <!-- /card -->
            </div>
            <!-- /tab-pane -->

            <div
              class="tab-pane fade"
              id="nav-profile"
              role="tabpanel"
              aria-labelledby="nav-profile-tab"
            >
              <div class="card">
                <div class="card-body">
                  <div class="form-group row">
                    <label
                      for="name"
                      class="col-md-4 col-form-label text-md-right"
                      >Username</label
                    >
                    <div class="col-md-6">
                      <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        required
                        autofocus
                        v-model="register_kost.name"
                        :class="[errors_2.name ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors_2.name">
                        {{ errors_2.name[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="email"
                      class="col-md-4 col-form-label text-md-right"
                      >E-Mail Address</label
                    >
                    <div class="col-md-6">
                      <input
                        id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        required
                        v-model="register_kost.email"
                        :class="[errors_2.email ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors_2.email">
                        {{ errors_2.email[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="password"
                      class="col-md-4 col-form-label text-md-right"
                      >Password</label
                    >
                    <div class="col-md-6">
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        required
                        v-model="register_kost.password"
                        :class="[errors_2.password ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors_2.password">
                        {{ errors_2.password[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="confirm_password"
                      class="col-md-4 col-form-label text-md-right"
                      >Confirm Password</label
                    >
                    <div class="col-md-6">
                      <input
                        id="confirm_password"
                        type="password"
                        class="form-control"
                        name="confirm_password"
                        required
                        v-model="register_kost.password_confirmation"
                      />
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="phone"
                      class="col-md-4 col-form-label text-md-right"
                      >Phone Number</label
                    >
                    <div class="col-md-6">
                      <input
                        id="phone"
                        type="text"
                        class="form-control"
                        name="phone"
                        required
                        v-model="register_kost.phone"
                        :class="[errors_2.phone ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors_2.phone">
                        {{ errors_2.phone[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row">
                    <label
                      for="address"
                      class="col-md-4 col-form-label text-md-right"
                      >Address</label
                    >
                    <div class="col-md-6">
                      <input
                        id="address"
                        type="text"
                        class="form-control"
                        name="address"
                        required
                        v-model="register_kost.address"
                        :class="[errors_2.address ? 'is-invalid' : '']"
                      />
                      <small class="text-danger" v-if="errors_2.address">
                        {{ errors_2.address[0] }}
                      </small>
                    </div>
                    <!-- /col-md-6 -->
                  </div>
                  <!-- /form-group -->

                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button
                        type="submit"
                        class="btn btn-primary"
                        @click="registerKost"
                      >
                        Register
                      </button>
                    </div>
                  </div>
                </div>
                <!-- /card-body -->
              </div>
              <!-- /card -->
            </div>
            <!-- /tab-pane -->
          </div>
          <!-- /tab-content -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["home"],
  data() {
    return {
      register_pengguna: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      register_kost: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        phone: "",
        address: "",
      },
      errors: [],
      errors_2: []
    };
  },
  methods: {
    registerPengguna() {
      axios
        .post("/register", this.register_pengguna)
        .then(res => {
          window.location = this.home;
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
    },
    registerKost() {
      axios
        .post("/register/kost", this.register_kost)
        .then(res => {
          window.location = this.home;
        })
        .catch(err => {
          this.errors_2 = err.response.data.errors;
        });
    }
  }
};
</script>

<style>
.hover-pointer:hover {
  cursor: pointer !important;
}
.custom-file-uploader {
  position: relative;
  border-bottom-left-radius: 0px;
  border-top-left-radius: 0px;
  color: #495057;
  border-left-width: 0px;
  border-color: #ced4da;
  background-color: #e9ecef;
  cursor: pointer;
}
.custom-file-uploader:hover,
.custom-file-uploader:focus,
.custom-file-uploader:active {
  cursor: pointer;
  color: #495057 !important;
  border-color: #ced4da !important;
  background-color: #e9ecef !important;
}
.custom-file-uploader input[type="file"] {
  display: block;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 5;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: default;
}
.custom-file-upload .form-control.bg-white {
  background-color: white !important;
}
</style>
