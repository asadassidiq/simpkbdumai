import Login from './components/Login.vue';
import Home from './components/Home.vue';
import Pendaftaran from './views/pendaftaran.vue';
import Pendaftarans from './views/pengujian/index.vue';
import Datakendaraans from './views/datakendaraan/index.vue';
import Datakendaraan from './views/datakendaraan/datakendaraan.vue';
import Datakendaraanlulus from './views/pengujian/datakendaraanlulus.vue';
import Uji from './views/pengujian/uji.vue';
import Verif from './views/pengujian/verif.vue';
import Verifall from './views/pengujian/verifall.vue';
import veriflulus from './views/pengujian/lulusverif.vue';
import Verifgagal from './views/pengujian/gagalverif.vue';
import Lulus from './views/pengujian/lulus.vue';
import TidakLulus from './views/pengujian/tidaklulus.vue';

export const routes = [
    {
        path : '/uji/home',
        component : Home,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/pendaftarans',
        component : Pendaftarans,
        meta:{
            requireAuth : true
        }
    },

    {
        path : '/uji/verif',
        component : Verif,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/verifall',
        component : Verifall,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/veriflulus',
        component : veriflulus,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/verifgagal',
        component : Verifgagal,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/pendaftaran/:id?',
        component : Pendaftaran,
        meta:{
            requireAuth : true
        }
    },
    {
        path : '/uji/datakendaraanlulus',
        component : Datakendaraanlulus,
        meta:{
            requireAuth : true
        }
    },    
    {
        path : '/uji/pengujians/:id?',
        component : Uji,
        meta:{
            requireAuth : true
        }
    },   
    {
        path : '/uji/lulus',
        component : Lulus,
        meta:{
            requireAuth : true
        }
    },   
    {
        path : '/uji/tidaklulus',
        component : TidakLulus,
        meta:{
            requireAuth : true
        }
    },

]