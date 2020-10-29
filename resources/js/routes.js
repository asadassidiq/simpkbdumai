import Login from './components/Login.vue';
import Home from './components/Home.vue';
import Post from './components/views/post.vue';
import Pendaftaran from './views/pendaftaran.vue';
import Pendaftaranall from './views/pendaftaran/alldata.vue';
import Pendaftarans from './views/pendaftaran/index.vue';
import Datakendaraans from './views/datakendaraan/index.vue';
import Datakendaraanall from './views/datakendaraan/alldata.vue';
import Bukubesar from './views/datakendaraan/bukubesar.vue';
import Datakendaraan from './views/datakendaraan/datakendaraan.vue';
import Numpangs from './views/numpang/index.vue';
import Numpangalls from './views/numpang/alldata.vue';
import Mutasi from './views/mutasi/index.vue';
import Mutasiall from './views/mutasi/alldata.vue';
import Uji from './views/pengujian/uji.vue';
import SetPosUji from './views/setting/set_posuji.vue';
import ListUji from './views/pengujian/index.vue';
import Verif from './views/pengujian/verif.vue';
import Mereks from './views/master/merek.vue';
import Tipe from './views/master/klasifikasi.vue';
import Klasifikasi from './views/master/klasifikasi.vue';
import Jenis from './views/master/jenis.vue';
import Transaksis from './views/Transaksi/index.vue';
import Transaksiall from './views/Transaksi/indexall.vue';
import Transaksi from './views/Transaksi/transaksi.vue';
import Managementusers from './views/Management/index.vue';
import Managementuser from './views/Management/user.vue';
import listitemuji from './views/Management/listitemuji.vue';
import Datakendaraanlulus from './views/pengujian/datakendaraanlulus.vue';
import Laporan from './views/cetak/lappendaftaranloket.vue';
import Hasiluji from './views/cetak/hasiluji.vue';
import Hasilujiall from './views/cetak/hasilujiall.vue';

export const routes = [
    {
        path : '/admin/login',
        component : Login,
       
    },
    {
        path : '/admin/laporan',
        component : Laporan,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/hasiluji',
        component : Hasiluji,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/hasilujiall',
        component : Hasilujiall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/home',
        component : Home,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/post/:id?',
        component : Post,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/pendaftarans',
        component : Pendaftarans,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/pendaftaran/:id?',
        component : Pendaftaran,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/pendaftaranall/',
        component : Pendaftaranall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/datakendaraans',
        component : Datakendaraans,
        meta:{
            requireAuth : true
        }
    },

    {
        path : '/admin/datakendaraanall',
        component : Datakendaraanall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/bukubesar',
        component : Bukubesar,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/datakendaraan/:id?',
        component : Datakendaraan,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/numpangs',
        component : Numpangs,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/numpangalls',
        component : Numpangalls,
        meta:{
            requireAuth : true
        }
    },

    {
        path : '/admin/mutasi',
        component : Mutasi,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/mutasiall',
        component : Mutasiall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/pengujian',
        component : ListUji,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/pengujians/:id?',
        component : Uji,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/mereks',
        component : Mereks,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/tipe',
        component : Tipe,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/klasifikasi',
        component : Klasifikasi,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/jenis',
        component : Jenis,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/setting/posuji',
        component : SetPosUji,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/verif',
        component : Verif,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/transaksis',
        component : Transaksis,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/transaksiall',
        component : Transaksiall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/transaksi/:id?',
        component : Transaksi,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/managementuser',
        component : Managementusers,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/managementuser/:id?',
        component : Managementuser,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/listitemuji',
        component : listitemuji,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/admin/datakendaraanlulus',
        component : Datakendaraanlulus,
        meta:{
            requireAuth : true
        }
    },

]