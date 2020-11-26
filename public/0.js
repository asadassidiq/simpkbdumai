(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      search: '',
      headers1: [{
        text: 'No Kendaraan',
        value: 'identitaskendaraan.noregistrasikendaraan'
      }, {
        text: 'No Uji',
        value: 'identitaskendaraan.nouji'
      }, {
        text: 'Nama',
        value: 'identitaskendaraan.nama'
      }, {
        text: 'Jbb',
        value: 'identitaskendaraan.jbb'
      }, {
        text: 'Th Pembuatan',
        value: 'identitaskendaraan.thpembuatan'
      }, {
        text: 'Jenis Pendaftaran',
        value: 'kodepenerbitans.keterangan'
      }, {
        text: 'Actions',
        value: 'actions',
        sortable: false
      }],
      halamanaksespendaftaran: [],
      form: new Form({})
    };
  },
  methods: {
    deletependaftaran: function deletependaftaran(id) {
      var _this = this;

      Swal.fire({
        title: 'Anda yakin hapus pendaftaran ini?',
        text: "Silahkan pastikan data yang di hapus benar!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then(function (result) {
        if (result.value) {
          _this.form["delete"]('/api/pendaftaran/' + id);

          Fire.$emit('afterCreate');
          Swal.fire('Deleted!', 'success');
        } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire('Cancelled', 'Data masih tersimpan)', 'error');
        }
      });
    },
    print1: function print1(id) {
      window.open('/cetak/' + id + '/printlmbrpermohonan', "_blank");
    },
    print2: function print2(id) {
      window.open('/cetak/' + id + '/printlmbrpemeriksaan', "_blank");
    },
    refreshPostpend: function refreshPostpend() {
      this.$store.dispatch('getPendaftarans');
    },
    editpendaftaran: function editpendaftaran(id) {
      this.$router.push('/admin/pendaftaran/' + id);
    },
    lanjutuji: function lanjutuji(id) {
      axios({
        url: '/api/lanjutuji/' + id,
        method: "post"
      }).then(function (result) {
        Swal.fire({
          type: 'success',
          title: 'saved',
          showConfirmButton: false,
          timer: 500
        });
      })["catch"](function (err) {});
    },
    initialize: function initialize() {
      var _this2 = this;

      var id = JSON.parse(localStorage.getItem("user"));
      axios({
        url: '/api/cekakses/',
        method: "POST",
        data: {
          user_id: id.id,
          halaman: '1'
        }
      }).then(function (result) {
        _this2.halamanaksespendaftaran = result.data.halamanakses;
      })["catch"](function (err) {});
    }
  },
  computed: {
    pendaftarans: function pendaftarans() {
      return this.$store.getters.pendaftarans;
    }
  },
  mounted: function mounted() {
    if (this.pendaftarans.length) {
      return;
    }

    this.$store.dispatch('getPendaftarans');
  },
  created: function created() {
    var _this3 = this;

    Fire.$on('afterCreate', function () {
      _this3.refreshPostpend();
    });
    this.initialize();
    this.refreshPostpend();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-container",
    { attrs: { fluid: "" } },
    [
      _c(
        "router-link",
        { attrs: { to: "/admin/pendaftaran/" } },
        [
          _c(
            "v-btn",
            {
              attrs: {
                bottom: "",
                color: "pink",
                dark: "",
                fab: "",
                fixed: "",
                right: ""
              }
            },
            [_c("v-icon", [_vm._v("mdi-plus")])],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-card",
        { attrs: { color: "lime lighten-3 black--text" } },
        [
          _c(
            "v-card-title",
            [
              _vm._v("\r\n      Pendaftaran\r\n      "),
              _c("v-spacer"),
              _vm._v(" "),
              _c("v-text-field", {
                attrs: {
                  "append-icon": "mdi-magnify",
                  label: "Search",
                  "single-line": "",
                  "hide-details": ""
                },
                model: {
                  value: _vm.search,
                  callback: function($$v) {
                    _vm.search = $$v
                  },
                  expression: "search"
                }
              }),
              _vm._v(" "),
              _c(
                "v-btn",
                {
                  attrs: {
                    bottom: "",
                    color: "green",
                    dark: "",
                    fab: "",
                    small: ""
                  },
                  on: { click: _vm.refreshPostpend }
                },
                [_c("v-icon", [_vm._v("mdi-refresh")])],
                1
              ),
              _vm._v(" "),
              _c(
                "router-link",
                { attrs: { to: "/admin/pendaftaran/" } },
                [
                  _c(
                    "v-btn",
                    { attrs: { bottom: "", color: "pink", dark: "" } },
                    [_vm._v("\r\n        Data Keseluruhan\r\n      ")]
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("v-data-table", {
        staticClass: "elevation-1 yellow lighten-3",
        attrs: {
          headers: _vm.headers1,
          items: _vm.pendaftarans,
          search: _vm.search
        },
        scopedSlots: _vm._u([
          {
            key: "item.actions",
            fn: function(ref) {
              var item = ref.item
              return [
                _c(
                  "div",
                  { staticClass: "text-center d-flex align-center" },
                  [
                    _c(
                      "v-tooltip",
                      {
                        attrs: { top: "" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "v-btn",
                                    _vm._g(
                                      {
                                        staticClass: "v-btn-simple",
                                        attrs: { color: "success", icon: "" },
                                        on: {
                                          click: function($event) {
                                            return _vm.editpendaftaran(item.id)
                                          }
                                        }
                                      },
                                      on
                                    ),
                                    [_c("v-icon", [_vm._v("mdi-pencil")])],
                                    1
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [_vm._v(" "), _c("span", [_vm._v("edit")])]
                    ),
                    _vm._v(" "),
                    _c(
                      "v-tooltip",
                      {
                        attrs: { top: "" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "v-btn",
                                    _vm._g(
                                      {
                                        staticClass: "v-btn-simple",
                                        attrs: { color: "primary", icon: "" },
                                        on: {
                                          click: function($event) {
                                            return _vm.print1(item.id)
                                          }
                                        }
                                      },
                                      on
                                    ),
                                    [
                                      _c("v-icon", [
                                        _vm._v("mdi-printer-check")
                                      ])
                                    ],
                                    1
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [
                        _vm._v(" "),
                        _c("span", [_vm._v("print Lembar Permohonan")])
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "v-tooltip",
                      {
                        attrs: { top: "" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "v-btn",
                                    _vm._g(
                                      {
                                        staticClass: "v-btn-simple",
                                        attrs: { color: "primary", icon: "" },
                                        on: {
                                          click: function($event) {
                                            return _vm.print2(item.id)
                                          }
                                        }
                                      },
                                      on
                                    ),
                                    [
                                      _c("v-icon", [
                                        _vm._v("mdi-printer-check")
                                      ])
                                    ],
                                    1
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [
                        _vm._v(" "),
                        _c("span", [_vm._v("print Lembar Pemeriksaan")])
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "v-tooltip",
                      {
                        attrs: { top: "" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "v-btn",
                                    _vm._g(
                                      {
                                        staticClass: "v-btn-simple",
                                        attrs: { color: "accent", icon: "" },
                                        on: {
                                          click: function($event) {
                                            return _vm.lanjutuji(item.id)
                                          }
                                        }
                                      },
                                      on
                                    ),
                                    [
                                      _c("v-icon", [
                                        _vm._v("mdi-account-arrow-right")
                                      ])
                                    ],
                                    1
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [_vm._v(" "), _c("span", [_vm._v("lanjut uji")])]
                    ),
                    _vm._v(" "),
                    _c(
                      "v-tooltip",
                      {
                        attrs: { top: "" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "v-btn",
                                    _vm._g(
                                      {
                                        staticClass: "v-btn-simple",
                                        attrs: { color: "error", icon: "" },
                                        on: {
                                          click: function($event) {
                                            return _vm.print(
                                              item.identitaskendaraan_id
                                            )
                                          }
                                        }
                                      },
                                      on
                                    ),
                                    [_c("v-icon", [_vm._v("mdi-pdf-box")])],
                                    1
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [_vm._v(" "), _c("span", [_vm._v("pdf")])]
                    ),
                    _vm._v(" "),
                    _vm.halamanaksespendaftaran.delete == "1"
                      ? _c(
                          "v-tooltip",
                          {
                            attrs: { top: "" },
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "activator",
                                  fn: function(ref) {
                                    var on = ref.on
                                    return [
                                      _c(
                                        "v-btn",
                                        _vm._g(
                                          {
                                            staticClass: "v-btn-simple",
                                            attrs: { color: "error", icon: "" },
                                            on: {
                                              click: function($event) {
                                                return _vm.deletependaftaran(
                                                  item.id
                                                )
                                              }
                                            }
                                          },
                                          on
                                        ),
                                        [
                                          _c("v-icon", [
                                            _vm._v("mdi-trash-can")
                                          ])
                                        ],
                                        1
                                      )
                                    ]
                                  }
                                }
                              ],
                              null,
                              true
                            )
                          },
                          [_vm._v(" "), _c("span", [_vm._v("delete")])]
                        )
                      : _vm._e()
                  ],
                  1
                )
              ]
            }
          }
        ])
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/pendaftaran/alldata.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/pendaftaran/alldata.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./alldata.vue?vue&type=template&id=7d7c044f& */ "./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f&");
/* harmony import */ var _alldata_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./alldata.vue?vue&type=script&lang=js& */ "./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _alldata_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__["render"],
  _alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pendaftaran/alldata.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_alldata_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./alldata.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pendaftaran/alldata.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_alldata_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./alldata.vue?vue&type=template&id=7d7c044f& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/pendaftaran/alldata.vue?vue&type=template&id=7d7c044f&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_alldata_vue_vue_type_template_id_7d7c044f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);