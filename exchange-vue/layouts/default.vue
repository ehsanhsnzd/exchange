<template>
  <div>
    <!-- Vertical navbar -->
    <div class="vertical-nav bg-white" id="sidebar">
      <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center">
          <div  alt="..." width="65" class="fa fa-3x fa-user mr-3 rounded-circle img-thumbnail shadow-sm">
          </div>
          <div class="media-body">
            <h4 class="m-0">{{user.name}}</h4>
            <p class="font-weight-light text-muted mb-0">Welcome</p>
          </div>
        </div>
      </div>

      <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a  @click="$router.push('/user')"  class="nav-link text-dark font-italic bg-light">
            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a  @click="$router.push('/user/profile')"  class="nav-link text-dark font-italic bg-light">
            <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
            Profile
          </a>
        </li>
        <li class="nav-item">
          <a @click="$router.push('/user/history')" class="nav-link text-dark font-italic bg-light">
            <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
            Trade History
          </a>
        </li>
      </ul>

      <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">XCHANGE</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a @click="$router.push({path:'/user/trade',query:{from:'1','to':2}})" class="pointer nav-link text-dark font-italic">
            <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
            USD/ETH
          </a>
        </li>
        <li class="nav-item">
          <a @click="$router.push({path:'/user/trade',query:{from:'1','to':6}})" class="pointer nav-link text-dark font-italic">
            <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
            USD/EUR
          </a>
        </li>
        <li class="nav-item">
          <a @click="$router.push({path:'/user/trade',query:{from:'1','to':3}})" class="pointer nav-link text-dark font-italic">
            <i class="fa fa-pie-chart mr-3 text-primary fa-fw"></i>
            USD/TRY
          </a>
        </li>
        <li class="nav-item">
          <a @click="$router.push({path:'/user/trade',query:{from:'2','to':1}})" class="pointer nav-link text-dark font-italic">
            <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
            ETH/USD
          </a>
        </li>
        <li class="nav-item">
          <a @click="$router.push({path:'/user/trade',query:{from:'4','to':1}});" class="pointer nav-link text-dark font-italic">
            <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
            XRP/USD
          </a>
        </li>
      </ul>
    </div>
    <!-- End vertical navbar -->

    <!-- Page content holder -->
    <div class="page-content p-5 " id="content ">

      <Nuxt></Nuxt>


    </div>
  </div>
</template>
<script>

import {mapActions} from "vuex";
import actionsTypes from '~/utils/store/actionTypes'

export default {
  data() {
    return {
      user:{}
    }
  },
  mounted() {
    this.profile()
  },
  methods:{
    ...mapActions({
      getProfile: actionsTypes.user.PROFILE,
    }),
    async profile(){
      let {meta,data} = await this.getProfile();
      if(meta.status == 'Success')
        this.user = data[0]
    },

  }
}
</script>

<style>
.pointer{
  cursor: pointer;
}
.vertical-nav {
  min-width: 17rem;
  width: 17rem;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.4s;
}

.page-content {
  width: calc(100% - 17rem);
  margin-left: 17rem;
  transition: all 0.4s;
}

/* for toggle behavior */

#sidebar.active {
  margin-left: -17rem;
}

#content.active {
  width: 100%;
  margin: 0;
}

@media (max-width: 768px) {
  #sidebar {
    margin-left: -17rem;
  }
  #sidebar.active {
    margin-left: 0;
  }
  #content {
    width: 100%;
    margin: 0;
  }
  #content.active {
    margin-left: 17rem;
    width: calc(100% - 17rem);
  }
}

/*
*
* ==========================================
* FOR DEMO PURPOSE
* ==========================================
*
*/

body {
  background: #599fd9;
  background: -webkit-linear-gradient(to right, #599fd9, #c2e59c);
  background: linear-gradient(to right, #599fd9, #c2e59c);
  min-height: 100vh;
  overflow-x: hidden;
}

.separator {
  margin: 3rem 0;
  border-bottom: 1px dashed #fff;
}

.text-uppercase {
  letter-spacing: 0.1em;
}

.text-gray {
  color: #aaa;
}
</style>
