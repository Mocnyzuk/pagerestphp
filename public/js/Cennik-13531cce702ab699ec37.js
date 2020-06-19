(window.webpackJsonp=window.webpackJsonp||[]).push([[2],{49:function(t,e,n){},53:function(t,e,n){"use strict";const i={data:()=>({content:null}),methods:{fetchData(t){return"string"!=typeof t?Promise.reject("invalid url"):this.$http({method:"get",url:t,headers:{"Content-Type":"application/json"}}).then(({data:t})=>{this.content=t})}}};e.a=i},57:function(t,e,n){"use strict";var i=n(49);n.n(i).a},60:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return t.content?n("v-container",[t._l(t.content.cennik,(function(e,i,a){return n("div",{key:a,staticClass:"table"},[n("h2",[t._v(t._s(i))]),t._v(" "),n("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[n("thead",{staticClass:"secondary lighten-3"},[n("td",[n("h3",[t._v("\n              Nazwa zabiegu\n            ")])]),t._v(" "),n("td",[n("h3",[t._v("Cena zabiegu")])]),t._v(" "),n("td",[n("h3",[t._v("Cena zabiegu w serii")])]),t._v(" "),t.editable?n("td",[n("h3",[t._v("Strona zabiegu")])]):t._e()]),t._v(" "),n("tbody",t._l(e,(function(e,i){return n("tr",{key:i,staticClass:"table__row"},[n("td",[e.zabieg?n("router-link",{attrs:{to:e.zabieg.urlPath}},[n("p",[t._v("\n                  "+t._s(e.name)+"\n                ")])]):n("p",[t._v(t._s(e.name))])],1),t._v(" "),n("td",[n("div",{attrs:{contenteditable:t.admin&&t.editable},on:{blur:function(n){return t.updatePrice(n,e,"priceOnce")}}},[t._v("\n                "+t._s(e.priceOnce||"")+"\n              ")])]),t._v(" "),n("td",[n("div",{attrs:{contenteditable:t.admin&&t.editable},on:{blur:function(n){return t.updatePrice(n,e,"priceSeries")}}},[t._v("\n                "+t._s(e.priceSeries||"")+"\n              ")])]),t._v(" "),t.editable&&t.admin?n("td",[n("treatment-picker",{attrs:{items:t.availableTreatments,ph:null===e.zabieg?"brak":e.zabieg.name},on:{input:function(n){return t.handleChange(n,e)}}})],1):t._e()])})),0)]},proxy:!0}],null,!0)})],1)})),t._v(" "),t.admin&&t.editable?n("v-btn",{staticClass:"primary",on:{click:t.savePriceList}},[t._v("Zapisz")]):t._e()],2):t._e()};i._withStripped=!0;var a=n(53),s=function(){var t=this.$createElement;return(this._self._c||t)("v-select",{staticClass:"mt-2",attrs:{items:this.items,dense:"",outlined:"",placeholder:this.ph},on:{change:this.asd}})};s._withStripped=!0;var r={props:["items","ph"],data:()=>({selected:""}),methods:{asd(t){this.$emit("input",t)}}},c=n(0),l=Object(c.a)(r,s,[],!1,null,null,null);l.options.__file="client/src/components/treatment-picker.vue";var o=l.exports,u={props:{editable:{type:Boolean,default:!1}},mixins:[a.a],components:{treatmentPicker:o},data:()=>({treatmentList:[]}),computed:{admin(){return this.$store.getters["auth/getRole"]("ROLE_ADMIN")},availableTreatments(){let t=this.treatmentList.map(t=>({text:t.name,value:t.urlPath}));return t=t.filter(t=>!this.allTreatments.find(e=>t.text===e.text)),[{text:"brak",value:null},...t]},allTreatments(){const t=this.content.cennik,e=[];for(let n in t)t[n].forEach(t=>{t.zabieg&&e.push({text:t.zabieg.name})});return e}},mounted(){this.$eventBus.$on("update-priceList",this.fetchTreatments),this.fetchData("/api/cennik").catch(t=>console.error(t)),this.admin&&this.fetchTreatments()},methods:{updatePrice(t,e,n){const i=t.target.innerText;e[n]=i},handleChange(t,e){e.zabieg=t?{urlPath:t}:null},savePriceList(){this.$http({method:"post",url:"/api/admin/cennik",headers:{"Content-type":"application/json"},data:this.content.cennik}).catch(t=>console.error(t))},fetchTreatments(){this.$http({method:"get",url:"/api/admin/zabieg"}).then(({data:t})=>{this.treatmentList=t})}}},d=(n(57),Object(c.a)(u,i,[],!1,null,"3247bd9a",null));d.options.__file="client/src/components/price-list.vue";e.a=d.exports},73:function(t,e,n){"use strict";n.r(e);var i=function(){var t=this.$createElement;return(this._self._c||t)("price-list")};i._withStripped=!0;var a={title:"Cennik",components:{priceList:n(60).a}},s=n(0),r=Object(s.a)(a,i,[],!1,null,null,null);r.options.__file="client/src/views/Cennik.vue";e.default=r.exports}}]);