(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/register/register"],{"34f4":function(e,t,a){"use strict";var n={auth:()=>Promise.all([a.e("common/vendor"),a.e("components/auth/auth")]).then(a.bind(null,"a32a")),bindPhone:()=>Promise.all([a.e("common/vendor"),a.e("components/bindPhone/bindPhone")]).then(a.bind(null,"9bb9")),"w-picker":()=>Promise.all([a.e("common/vendor"),a.e("components/w-picker/w-picker")]).then(a.bind(null,"7d1d2"))},i=function(){var e=this,t=e.$createElement;e._self._c},s=[];a.d(t,"b",function(){return i}),a.d(t,"c",function(){return s}),a.d(t,"a",function(){return n})},"7fcf":function(e,t,a){"use strict";var n=a("b8b6"),i=a.n(n);i.a},"8b82":function(e,t,a){"use strict";a.r(t);var n=a("34f4"),i=a("cb2e");for(var s in i)"default"!==s&&function(e){a.d(t,e,function(){return i[e]})}(s);a("7fcf");var o,r=a("f0c5"),c=Object(r["a"])(i["default"],n["b"],n["c"],!1,null,null,null,!1,n["a"],o);t["default"]=c.exports},a353:function(e,t,a){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=function(){return Promise.all([a.e("common/vendor"),a.e("components/w-picker/w-picker")]).then(a.bind(null,"7d1d2"))},i=(a("88e4"),{components:{wPicker:n},data:function(){return{$imgurl:this.$imgurl,a:"1",phoneNumber:"",date:null,region:null,allregion:["北京市","北京市","东城区"],addressDetail:"",name:"",page_signs:"/pages/register/register",formset:0,pagedata:[],beizhu:"",pagetype:"",formdescs:"",form_status:0,baseinfo:[],userbg:"",isover:0,wxmobile:"",myname:"",mymobile:"",myaddress:"",ttcxs:0,needAuth:!1,needBind:!1,superuser:"",tabList:[{mode:"region",name:"省市区",value:[0,0,0]}],userinfo:"",is_sub:!1}},onPullDownRefresh:function(){e.stopPullDownRefresh()},onLoad:function(t){if(void 0!=t.type&&(this.pagetype=t.type),t.from&&(this.from=t.from),t.fxsid)t.fxsid;e.setNavigationBarTitle({title:"开卡"}),this.region="北京市-北京市-东城区",this._getSuperUserInfo(this),this._baseMin(this),this.checkApply(),this.getUserinfo(),this.registerForm()},computed:{mode:function(){return this.tabList[0].mode},defaultVal:function(){return this.tabList[0].value}},methods:{cell:function(){this.needAuth=!1},closeAuth:function(){this.needAuth=!1,this.needBind=!0},closeBind:function(){console.log("closeBind"),this.needBind=!1,this.checkApply()},getSuid:function(){var t=e.getStorageSync("suid");if(t)return!0;var a="";return a=e.getStorageSync("baidu_userinfo"),a?this.needBind=!0:this.needAuth=!0,!1},toggleTab:function(){this.$refs.picker.show()},checkApply:function(){var t=this,a=e.getStorageSync("openid");e.request({url:t.$baseurl+"doPagecheckApply",data:{uniacid:t.$uniacid,suid:e.getStorageSync("suid"),openid:a,source:e.getStorageSync("source")},success:function(a){3==a.data.data.flag?e.showModal({title:"提示",content:"已有申请记录，请等待审核！",showCancel:!1,success:function(){e.redirectTo({url:"/pages/index/index"})}}):1!=a.data.data.flag&&4!=a.data.data.flag||e.showModal({title:"提示",content:"您已经是会员！",showCancel:!1,success:function(){e.navigateBack({delta:1})}}),t.userinfo=a.data.userinfo},fail:function(e){}})},registerForm:function(){var t=this,a=e.getStorageSync("openid");e.request({url:t.$baseurl+"doPageRegisterFrom",data:{uniacid:t.$uniacid,suid:e.getStorageSync("suid"),openid:a},success:function(e){1==e.data.data.flag?(t.formset=1,t.form_status=e.data.data.form_status,t.pagedata=e.data.data.form,t.beizhu=e.data.data.beizhu,t.formdescs=e.data.data.formdescs):(t.formset=0,t.form_status=e.data.data.form_status,t.beizhu=e.data.data.beizhu)},fail:function(e){}})},refreshSessionkey:function(){var t=this;e.login({success:function(a){e.request({url:t.$baseurl+"doPagegetNewSessionkey",data:{uniacid:t.$uniacid,code:a.code},success:function(e){t.newSessionKey=e.data.data}})}})},redirectto:function(e){var t=e.currentTarget.dataset.link,a=e.currentTarget.dataset.linktype;this._redirectto(t,a)},getUserinfo:function(){var t=this;e.request({url:t.$baseurl+"doPageMymoney",data:{uniacid:t.$uniacid,suid:e.getStorageSync("suid")},success:function(e){t.userbg=e.data.data.userbg,t.cardname=e.data.data.cardname}})},wxdz1:function(){var t=this;t.a="2",e.chooseAddress({success:function(e){t.name=e.userName,t.region=e.provinceName+"-"+e.countyName+"-"+e.cityName,t.addressDetail=e.detailInfo},fail:function(){e.showModal({title:"授权失败",content:"请重新授权",success:function(a){a.confirm&&e.openSetting({success:function(){e.getSetting({success:function(a){var n=a.authSetting;n["scope.address"]?e.chooseAddress({success:function(e){t.name=e.userName,t.region=e.provinceName+"-"+e.countyName+"-"+e.cityName,t.addressDetail=e.detailInfo}}):t.wxdz2()}})}}),a.cancel&&t.wxdz2()}})}})},wxdz2:function(){this.a="1"},getPhoneNumber:function(t){var a=this,n=t.detail.iv,i=t.detail.encryptedData;"getPhoneNumber:ok"==t.detail.errMsg?e.checkSession({success:function(){e.request({url:a.$baseurl+"doPagejiemiNew",data:{uniacid:a.$uniacid,newSessionKey:a.newSessionKey,iv:n,encryptedData:i},success:function(t){if(t.data.data){for(var n=a.pagedata,i=0;i<n.length;i++)0==n[i].type&&5==n[i].tp_text[0].yval&&(n[i].val=t.data.data);a.phoneNumber=t.data.data,a.wxmobile=t.data.data,a.pagedata=n}else e.showModal({title:"提示",content:"sessionKey已过期，请下拉刷新！"})},fail:function(e){}})},fail:function(){e.showModal({title:"提示",content:"sessionKey已过期，请下拉刷新！"})}}):e.showModal({title:"提示",content:"请先授权获取您的手机号！",showCancel:!1})},bindInputChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata;i[n].val=a,t.pagedata=i},bindPickerChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata,s=i[n].tp_text,o=s[a];i[n].val=o,t.pagedata=i},bindDateChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata;i[n].val=a,t.pagedata=i},bindTimeChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata;i[n].val=a,t.pagedata=i},checkboxChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata;i[n].val=a,t.pagedata=i},radioChange:function(e){var t=this,a=e.detail.value,n=e.currentTarget.dataset.index,i=t.pagedata;i[n].val=a,t.pagedata=i},choiceimg1111:function(t){var a=this,n=0,i=a.zhixin,s=t.currentTarget.dataset.index,o=a.pagedata,r=o[s].val,c=o[s].tp_text[0];r?n=r.length:(n=0,r=[]);var d=c-n;o[s].z_val&&o[s].z_val;e.chooseImage({count:d,sizeType:["original","compressed"],sourceType:["album","camera"],success:function(t){i=!0,a.zhixin=i,e.showLoading({title:"图片上传中"});var n=t.tempFilePaths,r=0,c=n.length,d=function t(){e.uploadFile({url:a.$baseurl+"wxupimg",formData:{uniacid:a.$uniacid},filePath:n[r],name:"file",success:function(n){o[s].z_val.push(n.data),a.pagedata=o,r++,r<c?t():(i=!1,a.zhixin=i,e.hideLoading())}})};d()}})},delimg:function(e){var t=this,a=e.currentTarget.dataset.index,n=e.currentTarget.dataset.id,i=t.pagedata,s=i[a].z_val;s.splice(n,1);var o=s.length;0==o&&(s=""),i[a].z_val=s,t.pagedata=i},namexz:function(e){for(var t=this,a=e.currentTarget.dataset.index,n=t.pagedata,i=n[a],s=[],o=0;o<i.tp_text.length;o++){var r={};r["keys"]=i.tp_text[o],r["val"]=1,s.push(r)}t.ttcxs=1,t.formindex=a,t.xx=s,t.xuanz=0,t.lixuanz=-1,t.riqi()},riqi:function(){for(var e=this,t=new Date,a=new Date(t.getTime()),n=a.getFullYear(),i=a.getMonth()+1,s=a.getDate(),o=n+"-"+i+"-"+s,r=e.xx,c=0;c<r.length;c++)r[c].val=1;e.xx=r,e.gettoday(o);var d=[],u=[],l=new Date;for(c=0;c<5;c++){var f=new Date(l.getTime()+24*c*3600*1e3),g=f.getFullYear(),h=f.getMonth()+1,p=f.getDate(),m=h+"月"+p+"日",v=g+"-"+h+"-"+p;d.push(m),u.push(v)}e.arrs=d,e.fallarrs=u,e.today=o},xuanzd:function(e){for(var t=this,a=e.currentTarget.dataset.index,n=t.fallarrs,i=n[a],s=t.xx,o=0;o<s.length;o++)s[o].val=1;t.xuanz=a,t.today=i,t.lixuanz=-1,t.xx=s,t.gettoday(i)},goux:function(e){var t=this,a=e.currentTarget.dataset.index;t.lixuanz=a},gettoday:function(t){var a=this,n=a.id,i="showPro_lv_buy",s=a.formindex,o=a.xx;e.request({url:a.$baseurl+"doPageDuzhan",data:{uniacid:a.$uniacid,id:n,types:i,days:t,pagedatekey:s},header:{"content-type":"application/json"},success:function(e){for(var t=e.data.data,n=0;n<t.length;n++)o[t[n]].val=2;var i=0;t.length==o.length&&(i=1),a.xx=o,a.isover=i}})},getPhoneNumber1:function(t){var a=this,n=t.detail.iv,i=t.detail.encryptedData;"getPhoneNumber:ok"==t.detail.errMsg?e.checkSession({success:function(){e.request({url:"entry/wxapp/jiemiNew",data:{newSessionKey:a.newSessionKey,iv:n,encryptedData:i},success:function(t){if(t.data.data){for(var n=a.pagedata,i=0;i<n.length;i++)0==n[i].type&&5==n[i].tp_text[0].yval&&(n[i].val=t.data.data);a.wxmobile=t.data.data,a.pagedata=n}else e.showModal({title:"提示",content:"sessionKey已过期，请下拉刷新！"})},fail:function(e){}})},fail:function(){e.showModal({title:"提示",content:"sessionKey已过期，请下拉刷新！"})}}):e.showModal({title:"提示",content:"请先授权获取您的手机号！",showCancel:!1})},weixinadd:function(){var t=this;e.chooseAddress({success:function(e){for(var a=e.provinceName+" "+e.cityName+" "+e.countyName+" "+e.detailInfo,n=e.userName,i=e.telNumber,s=t.pagedata,o=0;o<s.length;o++)0==s[o].type&&2==s[o].tp_text[0].yval&&(s[o].val=n),0==s[o].type&&3==s[o].tp_text[0].yval&&(s[o].val=i),0==s[o].type&&4==s[o].tp_text[0].yval&&(s[o].val=a);t.myname=n,t.mymobile=i,t.myaddress=a,t.pagedata=s},fail:function(t){e.getSetting({success:function(t){t.authSetting["scope.address"]||e.openSetting({success:function(e){}})}})}})},save_nb:function(){var t=this,a=t.today,n=t.xx,i=t.lixuanz;if(-1==i)return e.showModal({title:"提现",content:"请选择预约的选项",showCancel:!1}),!1;var s=n[i].keys.yval,o="已选择"+a+"，"+s,r=t.pagedata,c=t.formindex;r[c].val=o,r[c].days=a,r[c].indexkey=c,r[c].xuanx=i,t.ttcxs=0,t.pagedata=r},quxiao:function(){var e=this;e.ttcxs=0},changeName:function(e){this.name=e.detail.value},changeDate:function(e){this.date=e.detail.value},changeRegion:function(e){var t=e.checkArr,a=[t[0],t[1],t[2]];this.allregion=a,this.region=a.join("-"),console.log(this.region)},changeDetail:function(e){this.addressDetail=e.detail.value},confirmRegister:function(t){if(!this.getSuid())return!1;var a=this,n=(e.getStorageSync("suid"),t.detail.formId),i=a.form_status;if(1==i){if(!a.name)return e.showModal({title:"姓名不可为空！",content:"请重新输入",showCancel:!1}),!1;if(a.phoneNumber){if(!a.date)return e.showModal({title:"生日不可为空！",content:"请重新输入",showCancel:!1}),!1;if(!a.region)return e.showModal({title:"地区不可为空！",content:"请重新输入",showCancel:!1}),!1;if(!a.addressDetail)return e.showModal({title:"详细地址不可为空！",content:"请重新输入",showCancel:!1}),!1}else;}for(var s=a.pagedata,o=0;o<s.length;o++)if(1==s[o].ismust)if(5==s[o].type){if(""==s[o].z_val)return e.showModal({title:"提醒",content:s[o].name+"为必填项！",showCancel:!1}),!1}else{if(""==s[o].val)return e.showModal({title:"提醒",content:s[o].name+"为必填项！",showCancel:!1}),!1;if(0==s[o].type&&1==s[o]["tp_text"][0]["yval"]){var r=/^1[3456789]{1}\d{9}$/;if(!r.test(s[o].val))return e.showModal({title:"提醒",content:"请您输入正确的手机号码",showCancel:!1}),!1}else if(0==s[o].type&&7==s[o]["tp_text"][0]["yval"]){var c=/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;if(!c.test(s[o].val))return e.showModal({title:"提醒",content:"请您输入正确的身份证号",showCancel:!1}),!1}}var d=e.getStorageSync("openid");a.is_sub=!0,e.request({url:a.$baseurl+"doPageregisterVIP",data:{uniacid:a.$uniacid,openid:d,suid:e.getStorageSync("suid"),source:e.getStorageSync("source"),name:a.name,phoneNumber:a.phoneNumber,date:a.date,region:a.region,addressDetail:a.addressDetail,formId:n,cardname:a.cardname,pagedata:JSON.stringify(s),form_status:i},cachetime:"30",success:function(t){1==t.data.data?e.showModal({title:"提示",content:"申请成功，请等待审核！",showCancel:!1,success:function(t){e.redirectTo({url:"/pages/usercenter/usercenter"})}}):3==t.data.data?e.showToast({title:"开通成功！",icon:"success",success:function(){setTimeout(function(){e.redirectTo({url:"/pages/usercenter/usercenter"})},1500)}}):e.showModal({title:"提示",content:"申请失败",showCancel:!1})},fail:function(e){}})}}});t.default=i}).call(this,a("5486")["default"])},b8b6:function(e,t,a){},cb2e:function(e,t,a){"use strict";a.r(t);var n=a("a353"),i=a.n(n);for(var s in n)"default"!==s&&function(e){a.d(t,e,function(){return n[e]})}(s);t["default"]=i.a},f428:function(e,t,a){"use strict";(function(e){a("d28f");n(a("66fd"));var t=n(a("8b82"));function n(e){return e&&e.__esModule?e:{default:e}}e(t.default)}).call(this,a("5486")["createPage"])}},[["f428","common/runtime","common/vendor"]]]);