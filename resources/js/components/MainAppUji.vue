<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      app color="yellow lighten-1"
    >
      <v-list dense>
        <template v-for="item in items">
        <div v-if="cekdatahak(item.level) == true ">
          <v-row
            v-if="item.heading"
            :key="item.heading"
            align="center"
          >
            <v-col cols="6">
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-col>
            <v-col
              cols="6"
              class="text-center"
            >
              <a
                href="#!"
                class="body-2 black--text"
              >EDIT</a>
            </v-col>
          </v-row>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title :to="item.link">
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item
            v-else
            :key="item.text"
            :to="item.link"
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </div>
        </template>
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click="logout" color="lime darken-1">Logout</v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      color="yellow lighten-1"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="lime darken-1"></v-app-bar-nav-icon>
      <v-toolbar-title
        style="width: 300px"
        class="ml-0 pl-4"
      >
        <span class="hidden-sm-and-down black--text">SIM PKB DUMAI</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        icon
        large
      >
        <v-avatar
          size="32px"
          item
        >
          <v-img
            src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
            alt="Vuetify"
          ></v-img></v-avatar>
      </v-btn>
    </v-app-bar>
    <v-main>
        <router-view></router-view>
    </v-main>
    
  </v-app>
</template>

<script>
  export default {
    name: 'main-app',
    props: {
      source: String,
    },
    data: () => ({
      dialog: false,
      drawer: null,
      halamanakses:[],
      halaman:[],
      items: [
        { icon: 'mdi-view-dashboard', text: 'Dashboard', link: '/', level:'0' },
        { icon: 'mdi-clipboard-list-outline', text: 'Datakendaraan', link: '/uji/pendaftarans', level: '11' },
        { icon: 'mdi-clipboard-list-outline', text: 'Lulus', link: '/uji/lulus' , level:'11' },
        { icon: 'mdi-content-copy', text: 'Tidak Lulus', link: '/uji/tidaklulus', level: '11' },
        { icon: 'mdi-content-copy', text: 'Datakendaraan', link: '/uji/verif', level: '12' },
        { icon: 'mdi-content-copy', text: 'Lulus', link: '/uji/veriflulus', level: '12' },
        { icon: 'mdi-content-copy', text: 'Tidak Lulus', link: '/uji/verifgagal', level: '12' },
        { icon: 'mdi-content-copy', text: 'Semua Datakendaraan', link: '/uji/verifall', level: '12' },
      ],
    }),
    methods: {
      initialize () {
          var id = JSON.parse(localStorage.getItem("user"));
          axios({
                  url: '/api/navakses/'+id.id,
                  method: "GET",
              })
              .then((result) => {
                  this.halaman = result.data.halamanakses
              }).catch((err) => {

              });
          },
      cekdatahak(id){
        return this.halaman.includes(id);
      },
      logout(){
           this.$store.commit('logout');
            window.location.href = '/login';
           
       }
    },
    
    created() {
        this.initialize();
    },
  }
</script>