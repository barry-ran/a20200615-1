(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pagesPluginShop/manage_pro/manage_pro"],{"58e0":function(t,e,a){},8019:function(t,e,a){"use strict";var n=a("58e0"),i=a.n(n);i.a},"9f93":function(t,e,a){"use strict";(function(t){a("d28f");n(a("66fd"));var e=n(a("d486"));function n(t){return t&&t.__esModule?t:{default:t}}t(e.default)}).call(this,a("5486")["createPage"])},cb6e:function(t,e,a){"use strict";a.r(e);var n=a("e988"),i=a.n(n);for(var o in n)"default"!==o&&function(t){a.d(e,t,function(){return n[t]})}(o);e["default"]=i.a},ced8:function(t,e,a){"use strict";var n,i=function(){var t=this,e=t.$createElement;t._self._c},o=[];a.d(e,"b",function(){return i}),a.d(e,"c",function(){return o}),a.d(e,"a",function(){return n})},d486:function(t,e,a){"use strict";a.r(e);var n=a("ced8"),i=a("cb6e");for(var o in i)"default"!==o&&function(t){a.d(e,t,function(){return i[t]})}(o);a("8019");var s,c=a("f0c5"),l=Object(c["a"])(i["default"],n["b"],n["c"],!1,null,null,null,!1,n["a"],s);e["default"]=l.exports},e988:function(t,e,a){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;a("2f62");var n=a("88e4"),i={data:function(){return{$imgurl:this.$imgurl,baseinfo:"",needAuth:!1,needBind:!1,page_signs:"/pagesPluginShop/manage_pro/manage_pro",index:0,thumb:"",thumb_ok:"",id:"",hideAdd1:1,pagedata:[],host:"",video:"",cid:0,cateinfo:[],catelist:"",proInfo:"",imgs:[]}},onLoad:function(t){var e=this;this._baseMin(this);var a=t.id?t.id:"";this.id=a;var i=0;n.bdLogin(i,function(){a>0?e._getProInfo(a):e.getcate()})},methods:{_getProInfo:function(e){var a=this;t.request({url:a.$baseurl+"dopageshowShopPro",data:{id:e,uniacid:a.$uniacid,suid:t.getStorageSync("suid")},success:function(t){t.data.data.images&&(a.pagedata=t.data.data.images),a.thumb_ok=t.data.data.thumb,a.thumb=t.data.data.thumb,a.proInfo=t.data.data,a.imgs=a.pagedata,a.pagedata=a.pagedata,a.cid=a.proInfo.cid,a.getcate(),console.log(a.thumb)}})},getcate:function(){var e=this;t.request({url:e.$baseurl+"doPageGetGoodsCate",data:{uniacid:e.$uniacid,id:e.id},success:function(a){1==e.baseinfo.can_show&&t.setNavigationBarTitle({title:"商品详情"});e.id;var n=a.data.data.arr,i=a.data.data.index;e.cateinfo=n,e.index=i,e.catelist=a.data.data.list}})},bindPickerChange:function(t){var e=this,a=t.detail.value;if(a>0)var n=a-1;for(var i=e.catelist,o=0,s=0,c=0;c<i.length;c++)if(0==c)n==c?s=i[c]["id"]:n<i[c]["sub"].length+1&&(s=i[c]["sub"][n-1]["id"]);else if(o+=i[c]["sub"].length+1,n<o+i[0]["sub"].length+1)for(var l=0,u=o+i[0]["sub"].length+1-i[c]["sub"].length-1;u<o+i[0]["sub"].length+1;u++)u==n&&(s=0==l?i[c]["id"]:i[c]["sub"][l-1]["id"]),l+=1;e.index=a,e.cid=s},choosethumb:function(){var e=this,a=e.$baseurl+"wxupimg";t.chooseImage({count:1,sizeType:["original","compressed"],sourceType:["album","camera"],success:function(n){t.showLoading({title:"图片上传中"});var i=n.tempFilePaths;t.uploadFile({url:a,formData:{uniacid:e.$uniacid},filePath:i[0],name:"file",success:function(a){var n=a.data;e.thumb=n,e.thumb_ok=n,e.hideAdd1=0,t.hideLoading()}})}})},chooseZutu:function(){var e=this;t.chooseImage({count:3,sizeType:["original"],sourceType:["album","camera"],success:function(t){t.tempFilePaths.length>0&&e._uploadImg(t.tempFilePaths,1,function(t){console.log(t);var a=e.host+t,n=e.pagedata;n.push(a),console.log(n),e.pagedata.length>2?(e.hideAdd=0,e.imgs=e.pagedata):(e.hideAdd=1,e.imgs=n),e.pagedata=n,console.log(e.pagedata)})}})},_uploadImg:function(e,a,n){var i=this;if(2==a)t.uploadFile({url:i.$baseurl+"wxupimg",formData:{uniacid:i.$uniacid},filePath:e,name:"file",success:function(t){console.log("上传成功"),console.log(t),"function"==typeof n&&n(t.data)},fail:function(e){t.showModal({title:"错误提示",content:"上传失败",showCancel:!1})}});else for(var o=0;o<e.length;o++)t.uploadFile({url:i.$baseurl+"wxupimg",formData:{uniacid:i.$uniacid},filePath:e[o],name:"file",success:function(t){console.log("上传成功"),"function"==typeof n&&n(t.data)},fail:function(e){t.showModal({title:"错误提示",content:"上传失败",showCancel:!1})}})},getBLen:function(t){return null==t?0:("string"!=typeof t&&(t+=""),t.replace(/[^\x00-\xff]/g,"01").length)},delimg:function(t){var e=this,a=t.currentTarget.dataset.id,n=e.pagedata;n.splice(a,1),e.imgs=n,e.pagedata=n},isInt:function(t){var e=/^\d+(?=\.{0,1}\d+$|$)/;return!!e.test(t)},formSubmit:function(e){var a=this,n=e.detail.value,i=a.cid;return 0==i?(t.showModal({title:"提示",content:"请选择所属栏目",showCancel:!1}),!1):""==n["title"]?(t.showModal({title:"提示",content:"请输入商品标题",showCancel:!1}),!1):a.getBLen(n.title)>100?(t.showModal({title:"提示",content:"商品标题最多输入50个汉字",showCancel:!1}),!1):""==a.thumb_ok?(t.showModal({title:"提示",content:"请上传商品缩略图",showCancel:!1}),!1):a.pagedata.length<1?(t.showModal({title:"提示",content:"请至少上传一张商品组图",showCancel:!1}),!1):""==n["sellprice"]?(t.showModal({title:"提示",content:"请输入商品售价",showCancel:!1}),!1):a.isInt(n.sellprice)?""==n["storage"]?(t.showModal({title:"提示",content:"请输入商品库存",showCancel:!1}),!1):(console.log(989898989),console.log(a.pagedata),console.log(JSON.stringify(a.pagedata)),void t.request({url:a.$baseurl+"dopageaddPro",data:{title:n.title,num:n.num,pageview:n.pageview,buy_type:0,flag:0==n.flag?1:n.flag,kuaidi:0,rsales:n.rsales,sellprice:n.sellprice,marketprice:n.marketprice,storage:n.storage,descp:n.descp,images:JSON.stringify(a.pagedata),thumb:a.thumb,sid:t.getStorageSync("mlogin"),id:a.id,uniacid:a.$uniacid,cid:a.cid},success:function(e){0==e.data.data?t.showModal({title:"提示",content:"添加失败",showCancel:!1}):(t.showToast({title:"添加/修改成功",icon:"success"}),setTimeout(function(){t.redirectTo({url:"/pagesPluginShop/manage_prolist/manage_prolist"})},1e3))}})):(t.showModal({title:"提示",content:"商品售价应为正数",showCancel:!1}),!1)}}};e.default=i}).call(this,a("5486")["default"])}},[["9f93","common/runtime","common/vendor"]]]);