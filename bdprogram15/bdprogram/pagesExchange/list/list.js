(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pagesExchange/list/list"],{"0942":function(e,t,n){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=n("88e4"),i={data:function(){return{$imgurl:this.$imgurl,page_signs:"/pagesExchange/list/list",tongji:[],globaluser:[],cate_list:[],cate_list_length:0,c:"",page:1,morePro:!1,ProductsList:[],baseinfo:[],footer:{},cid:0,cate:"",needBind:!1,needAuth:!1}},onShareAppMessage:function(){var e=this;return{title:e.cateinfo.name+"-"+e.baseinfo.name}},onPullDownRefresh:function(){this.getList(),this.getCate(),e.stopPullDownRefresh()},onLoad:function(t){var n=this;n.cid=t.cid;var i=0;t.fxsid&&(i=t.fxsid,n.fxsid=t.fxsid),this._baseMin(this);e.getStorageSync("suid");a.bdLogin(i,function(){n.getList(),n.getCate()})},onReachBottom:function(){var t=this,n=t.page+1,a=t.cid;e.request({url:t.$baseurl+"doPageScorepro",data:{uniacid:t.$uniacid,cid:a,page:n},success:function(e){""!=e.data.data?(t.cate_list=t.cate_list.concat(e.data.data),t.page=n):t.morePro=!1}})},methods:{closeAuth:function(){this.needAuth=!1;var t=e.getStorageSync("golobeuser");t&&this._checkBindPhone(this)},closeBind:function(){this.needBind=!1,this.getList(),this.getCate()},redirectto:function(e){var t=e.currentTarget.dataset.link,n=e.currentTarget.dataset.linktype;this._redirectto(t,n)},handleTap:function(e){var t=this,n=e.currentTarget.id.slice(1);t.cid;n&&(t.cid=n,t.page=1,t.getList(n))},getCate:function(){var t=this;e.request({url:t.$baseurl+"doPageScorecate",data:{uniacid:t.$uniacid,source:e.getStorageSync("source"),suid:e.getStorageSync("suid")},success:function(e){t.cate=e.data.data.cate,t.globaluser=e.data.data.userinfo},fail:function(e){}})},getList:function(t){var n=this;void 0==t&&(t=0),e.request({url:n.$baseurl+"doPageScorepro",cachetime:"30",data:{uniacid:n.$uniacid,cid:t},success:function(a){n.cate_list=a.data.data,n.cate_list_length=a.data.data.length,n.cid=t,e.setNavigationBarTitle({title:"积分商城"}),e.setStorageSync("isShowLoading",!1),e.hideNavigationBarLoading(),e.stopPullDownRefresh()},fail:function(e){}})},makePhoneCall:function(t){var n=this,a=n.baseinfo.tel;e.makePhoneCall({phoneNumber:a})},makePhoneCallB:function(t){var n=this,a=n.baseinfo.tel_b;e.makePhoneCall({phoneNumber:a})},openMap:function(t){var n=this;e.openLocation({latitude:parseFloat(n.baseinfo.latitude),longitude:parseFloat(n.baseinfo.longitude),name:n.baseinfo.name,address:n.baseinfo.address,scale:22})},chenggfh:function(){var t=this,n=e.getStorageSync("golobeuser");t.isview=0,t.globaluser=n}}};t.default=i}).call(this,n("5486")["default"])},"09c2":function(e,t,n){"use strict";(function(e){n("d28f");a(n("66fd"));var t=a(n("ef05"));function a(e){return e&&e.__esModule?e:{default:e}}e(t.default)}).call(this,n("5486")["createPage"])},"304f":function(e,t,n){"use strict";n.r(t);var a=n("0942"),i=n.n(a);for(var o in a)"default"!==o&&function(e){n.d(t,e,function(){return a[e]})}(o);t["default"]=i.a},cf7a:function(e,t,n){"use strict";var a={auth:()=>Promise.all([n.e("common/vendor"),n.e("components/auth/auth")]).then(n.bind(null,"a32a")),bindPhone:()=>Promise.all([n.e("common/vendor"),n.e("components/bindPhone/bindPhone")]).then(n.bind(null,"9bb9")),copyright:()=>n.e("components/copyright/copyright").then(n.bind(null,"cb0f")),myfooter:()=>n.e("components/myfooter/myfooter").then(n.bind(null,"6bab"))},i=function(){var e=this,t=e.$createElement;e._self._c},o=[];n.d(t,"b",function(){return i}),n.d(t,"c",function(){return o}),n.d(t,"a",function(){return a})},d46b:function(e,t,n){"use strict";var a=n("d61e"),i=n.n(a);i.a},d61e:function(e,t,n){},ef05:function(e,t,n){"use strict";n.r(t);var a=n("cf7a"),i=n("304f");for(var o in i)"default"!==o&&function(e){n.d(t,e,function(){return i[e]})}(o);n("d46b");var c,s=n("f0c5"),r=Object(s["a"])(i["default"],a["b"],a["c"],!1,null,null,null,!1,a["a"],c);t["default"]=r.exports}},[["09c2","common/runtime","common/vendor"]]]);