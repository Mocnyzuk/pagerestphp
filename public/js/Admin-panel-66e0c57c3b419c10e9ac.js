(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{48:function(t,e,i){},49:function(t,e,i){},50:function(t,e,i){"use strict";e.a=t=>{const e={required:(t="To pole jest wymagane!")=>e=>!!e||t,number:t=>t&&Number.isInteger(Number(t))||"Podany numer nie jest poprawny!",email:t=>/.+@.+\..+/.test(t)||"Podany e-mail nie jest poprawny!",max:t=>e=>e&&e.length<=t||`Nie może przekraczać ${t} znaków!`,min:t=>e=>e&&e.length>t||`Musi zawierać conajmniej ${t} znaków!`,time:t=>/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(t)||"XX:XX"};if("string"==typeof t)return{data:()=>({rules:{[t]:e.hasOwnProperty(t)?e[t]:`Validation for "${current}" was not found`}})};if(Array.isArray(t)){const i=t.reduce((t,i)=>(t[i]=e.hasOwnProperty(i)?e[i]:`Validation for "${i}" was not found`,t),{});return{data:()=>({rules:i})}}return{data:()=>({rules:e})}}},51:function(t,e,i){"use strict";e.a={data:()=>({error:""}),methods:{handleApiError(t){try{t&&t.hasOwnProperty("response")&&t.response.hasOwnProperty("data")&&(this.error=t.response.data)}catch(t){this.error="INTERNAL_SERVER_ERROR"}}}}},52:function(t,e,i){"use strict";var a=i(48);i.n(a).a},53:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.active?i("v-container",{staticClass:"px-0",attrs:{fluid:""}},[i("p",{staticClass:"text-left my-0"},[t._v(t._s(t.active.size)+"/"+t._s(t.limit))]),t._v(" "),i("v-row",{attrs:{dense:""}},t._l(t.currentPage,(function(e,a){return i("v-col",{key:a,attrs:{cols:"6",xs:"6",lg:"2"}},[i("v-card",{staticClass:"overflow-hidden",on:{click:function(i){t.active.has(e.id)?t.removePic(e.id):t.addPic(e.id)}}},[i("v-img",{staticClass:"image",attrs:{src:e.path,height:"80px",width:"auto",cover:""}}),t._v(" "),t.active.has(e.id)?i("v-icon",{staticClass:"image__icon success lighten-1"},[t._v("mdi-check")]):t._e()],1)],1)})),1),t._v(" "),i("v-card-actions",[i("v-btn",{staticClass:"primary",attrs:{type:"submit"},on:{click:t.save}},[t._v("ZAPISZ")]),t._v(" "),i("v-spacer"),t._v(" "),i("v-btn",{on:{click:t.previousPage}},[i("v-icon",[t._v("mdi-arrow-left")])],1),t._v(" "),i("v-btn",{on:{click:t.nextPage}},[i("v-icon",[t._v("mdi-arrow-right")])],1)],1)],1):t._e()};a._withStripped=!0;var s={props:["value","limit","maxDisplayed","selected"],data:()=>({pageNum:0,active:null}),computed:{images(){return new Set(this.value)},currentPage(){return[...this.value].slice(this.pageNum*this.maxDisplayed,this.pageNum*this.maxDisplayed+this.maxDisplayed).map(t=>t)}},mounted(){this.active=new Set(this.$props.selected)},methods:{nextPage(){this.pageNum+1<this.images.size/this.maxDisplayed&&this.pageNum++},previousPage(){this.pageNum>0&&this.pageNum--},save(){this.$emit("submit",this.active)},addPic(t){1===this.active.size&&1===this.limit&&(this.active=new Set),this.active.size<this.limit&&(this.active=new Set(this.active.add(t)))},removePic(t){this.active.delete(t),this.active=new Set(this.active)}},watch:{selected(t,e){this.active=new Set(t)}}},n=(i(52),i(0)),r=Object(n.a)(s,a,[],!1,null,"346c8138",null);r.options.__file="client/src/components/app-image-picker.vue";e.a=r.exports},55:function(t,e,i){"use strict";var a=i(49);i.n(a).a},57:function(t,e,i){},58:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.content?i("v-container",[t._l(t.content.cennik,(function(e,a,s){return i("div",{key:s,staticClass:"table"},[i("h2",[t._v(t._s(a))]),t._v(" "),i("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[i("thead",{staticClass:"secondary lighten-3"},[i("td",[i("h3",[t._v("\n              Nazwa zabiegu\n            ")])]),t._v(" "),i("td",[i("h3",[t._v("Cena zabiegu")])]),t._v(" "),i("td",[i("h3",[t._v("Cena zabiegu w serii")])]),t._v(" "),i("td",[t.editable?i("h3",[t._v("asda")]):t._e()])]),t._v(" "),i("tbody",[t._l(e,(function(e,a){return i("tr",{key:a,staticClass:"table__row"},[i("td",[e.zabieg?i("router-link",{attrs:{to:e.zabieg.urlPath}},[t._v(t._s(e.name))]):i("p",[t._v(t._s(e.name))])],1),t._v(" "),i("td",[i("div",{attrs:{contenteditable:t.admin&&t.editable},on:{blur:function(i){return t.updatePrice(i,e,"priceOnce")}}},[t._v("\n                "+t._s(e.priceOnce||"")+"\n              ")])]),t._v(" "),i("td",[i("div",{attrs:{contenteditable:t.admin&&t.editable},on:{blur:function(i){return t.updatePrice(i,e,"priceSeries")}}},[t._v("\n                "+t._s(e.priceSeries||"")+"\n              ")])]),t._v(" "),t.editable&&t.admin?i("td",[i("treatment-picker",{attrs:{items:t.availableTreatments,ph:null===e.zabieg?"brak":e.zabieg.name},on:{input:function(i){return t.handleChange(i,e)}}})],1):t._e()])})),t._v(" "),t.editable&&t.admin?i("tr",[i("td",[i("v-text-field")],1),t._v(" "),i("td",[i("v-text-field")],1),t._v(" "),i("td",[i("v-text-field")],1)]):t._e()],2)]},proxy:!0}],null,!0)})],1)})),t._v(" "),t.admin&&t.editable?i("v-btn",{staticClass:"primary",on:{click:t.savePriceList}},[t._v("Zapisz")]):t._e()],2):t._e()};a._withStripped=!0;var s={data:()=>({content:null}),methods:{fetchData(t){return t&&"string"==typeof t?this.$http({method:"get",url:t,headers:{"Content-Type":"application/json"}}).then(({data:t})=>{this.content=t}):Promise.reject("invalid url")}}},n=function(){var t=this.$createElement;return(this._self._c||t)("v-select",{staticClass:"mt-2",attrs:{items:this.items,dense:"",outlined:"",placeholder:this.ph},on:{change:this.asd}})};n._withStripped=!0;var r={props:["items","ph"],data:()=>({selected:""}),methods:{asd(t){this.$emit("input",t)}}},l=i(0),c=Object(l.a)(r,n,[],!1,null,null,null);c.options.__file="client/src/components/treatment-picker.vue";var o=c.exports,d={props:{editable:{type:Boolean,default:!1}},mixins:[s],components:{treatmentPicker:o},data:()=>({treatmentList:[]}),computed:{admin(){return this.$store.getters["auth/getRole"]("ROLE_ADMIN")},availableTreatments(){let t=this.treatmentList.map(t=>({text:t.name,value:t.urlPath}));return t=t.filter(t=>!this.allTreatments.find(e=>t.text===e.text)),[{text:"brak",value:null},...t]},allTreatments(){const t=this.content.cennik,e=[];for(let i in t)t[i].forEach(t=>{t.zabieg&&e.push({text:t.zabieg.name})});return e}},mounted(){this.$eventBus.$on("update-priceList",this.fetchTreatments),this.fetchData("/api/cennik").catch(t=>console.error(t)),this.fetchTreatments()},methods:{updatePrice(t,e,i){const a=t.target.innerText;e[i]=a},handleChange(t,e){e.zabieg=t?{urlPath:t}:null},savePriceList(){this.$http({method:"post",url:"/api/admin/cennik",headers:{"Content-type":"application/json"},data:this.content.cennik}).catch(t=>console.error(t))},fetchTreatments(){this.$http({method:"get",url:"/api/admin/zabieg"}).then(({data:t})=>{this.treatmentList=t})}}},p=(i(55),Object(l.a)(d,a,[],!1,null,"3247bd9a",null));p.options.__file="client/src/components/price-list.vue";e.a=p.exports},61:function(t,e,i){"use strict";var a=i(57);i.n(a).a},62:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this.$createElement,e=this._self._c||t;return e("main",[e("v-row",{staticClass:"view",attrs:{dense:""}},[e("v-col",{attrs:{cols:"12",lg:"6",md:"12"}},[e("add-file-form",{staticClass:"py-4 px-4 mb-4"}),this._v(" "),e("edit-hours-form",{staticClass:"px-4 py-4"})],1),this._v(" "),e("v-col",{attrs:{cols:"12",lg:"6"}},[e("edit-slideshow-form",{staticClass:"px-4 py-4 mb-4"}),this._v(" "),e("edit-treatment-form",{staticClass:"px-4 py-4 mb-4"})],1)],1),this._v(" "),e("v-row",{staticClass:"view",attrs:{dense:""}},[e("edit-prices")],1)],1)};a._withStripped=!0;var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-title",[t._v("Dodaj zdjęcie")]),t._v(" "),i("v-form",{on:{submit:function(t){t.preventDefault()}}},[i("v-file-input",{ref:"file",attrs:{accept:"image/*"},model:{value:t.file,callback:function(e){t.file=e},expression:"file"}}),t._v(" "),i("v-card-actions",[i("v-btn",{staticClass:"primary",on:{click:t.submitFile}},[t._v("DODAJ")])],1)],1),t._v(" "),t.error?i("h4",{staticClass:"error px-4 py-4"},[t._v(t._s(t.error))]):t._e()],1)};s._withStripped=!0;var n=i(51),r={mixins:[n.a],data:()=>({file:null}),methods:{submitFile(){let t=new FormData;t.append("file",this.file),this.$http.post("/files/uploadfile/zdjecia",t,{headers:{"Content-Type":"multipart/form-data"}}).then(()=>{this.file=null,this.$store.dispatch("admin/fetchData","/api/admin")}).catch(this.handleApiError)},handleFileUpload(){this.$refs.file.files[0]&&(this.file=this.$refs.file.files[0])}}},l=i(0),c=Object(l.a)(r,s,[],!1,null,null,null);c.options.__file="client/src/views/admin-panel/add-file-form.vue";var o=c.exports,d=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-title",[i("p",[t._v("Edytuj godziny otwarcia")])]),t._v(" "),t.open?i("v-form",[t.data&&t.data.openHours?i("v-list",t._l(t.data.openHours,(function(e){return i("v-list-item",{key:e.day},[i("v-list-item-title",[t._v(t._s(e.day))]),t._v(" "),i("v-text-field",{staticClass:"mx-2",attrs:{placeholder:e.open,rules:[t.rules.required("Wpisz godzinę!"),t.rules.time]},model:{value:e.open,callback:function(i){t.$set(e,"open",i)},expression:"item.open"}}),t._v("\n        :\n        "),i("v-text-field",{staticClass:"mx-2",attrs:{rules:e.close?[t.rules.required(),t.rules.time]:[],placeholder:e.close},model:{value:e.close,callback:function(i){t.$set(e,"close",i)},expression:"item.close"}})],1)})),1):t._e()],1):t._e(),t._v(" "),i("v-card-actions",[i("v-btn",{staticClass:"primary",on:{click:function(e){t.open?t.save():t.openForm()}}},[t._v(t._s(t.open?"Zapisz":"Edytuj")+"\n    ")])],1),t._v(" "),t.error?i("h4",{staticClass:"error px-4 py-3"},[t._v(t._s(t.error))]):t._e()],1)};d._withStripped=!0;var p=i(4),h=i(50),u=i(23),m={mixins:[Object(h.a)(["required","time"]),n.a],data:()=>({open:!0,data:null}),created(){this.$store.dispatch("admin/fetchData","/api/admin/kontakt").then(t=>{this.data=Object(u.a)(t)}).catch(this.handleApiError)},methods:{openForm(){this.open=!0},save(){this.$store.dispatch("admin/save",this.data).then(()=>this.open=!1).catch(this.handleApiError)}}},v=Object(l.a)(m,d,[],!1,null,null,null);v.options.__file="client/src/views/admin-panel/edit-hours-form.vue";var _=v.exports,f=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-title",[t._v("Slideshow")]),t._v(" "),t.images&&t.slides?i("app-image-picker",{attrs:{value:t.images,selected:t.slides,limit:6,maxDisplayed:6},on:{submit:t.save}}):t._e(),t._v(" "),t.error?i("h4",{staticClass:"error px-4 py-4"},[t._v(t._s(t.error))]):t._e()],1)};f._withStripped=!0;var b=i(53),w={mixins:[n.a],components:{appImagePicker:b.a},created(){this.$store.dispatch("admin/fetchData","/api/admin/slideshow").then(({slideshow:t})=>{this.slideshow=t,this.slides=new Set(t.slides)}).catch(this.handleApiError)},data:()=>({slideshow:null,slides:null}),computed:{...Object(p.b)({images:t=>t.admin.images})},methods:{save(t){this.slideshow.slides=[...t],this.$http({method:"post",url:"/api/admin/slideshow",data:this.slideshow}).catch(this.handleApiError)}}},g=Object(l.a)(w,f,[],!1,null,"e627a84a",null);g.options.__file="client/src/views/admin-panel/edit-slideshow-form.vue";var y=g.exports,x=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-card",[i("v-card-title",[t._v("Edytuj listę zabiegów")]),t._v(" "),i("v-form",[i("v-list",[t._l(t.content,(function(e){return i("v-list-item",{key:e.urlPath},[i("p",[t._v(t._s(e.name))])])})),t._v(" "),i("v-list-item",[i("v-text-field",{model:{value:t.newTreatment,callback:function(e){t.newTreatment=e},expression:"newTreatment"}}),t._v(" "),i("v-btn",{on:{click:t.addTreatment}},[t._v("add")])],1)],2)],1)],1)};x._withStripped=!0;var k={data:()=>({content:null,dialog:!1,modal:null,newProcedure:null,newTreatment:null}),mounted(){this.$store.dispatch("admin/fetchData","/api/admin/zabieg").then(t=>{this.content=t})},methods:{addTreatment(){this.$http({method:"post",url:"/api/admin/zabieg",header:{"Content-type":"application/json"},data:{name:this.newTreatment}}).then(()=>(this.newTreatment="",this.$store.dispatch("appState/fetchData"),this.$eventBus.$emit("update-priceList"),this.$store.dispatch("admin/fetchData","/api/admin/zabieg"))).then(t=>{this.content=t})}}},$=Object(l.a)(k,x,[],!1,null,null,null);$.options.__file="client/src/views/admin-panel/edit-treatment-form.vue";var z=$.exports,C=function(){var t=this.$createElement,e=this._self._c||t;return e("v-container",{attrs:{fluid:""}},[e("price-list",{attrs:{editable:!0}})],1)};C._withStripped=!0;var P={components:{priceList:i(58).a}},j=Object(l.a)(P,C,[],!1,null,null,null);j.options.__file="client/src/views/admin-panel/edit-prices.vue";var E={title:"Panel administratora",components:{addFileForm:o,editHoursForm:_,editSlideshowForm:y,editTreatmentForm:z,editPrices:j.exports}},S=(i(61),Object(l.a)(E,a,[],!1,null,"4cdde6b8",null));S.options.__file="client/src/views/Admin-panel.vue";e.default=S.exports}}]);