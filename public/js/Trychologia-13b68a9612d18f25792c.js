(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{48:function(t,e,i){},52:function(t,e,i){"use strict";var a=i(48);i.n(a).a},53:function(t,e,i){"use strict";var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.active?i("v-container",{staticClass:"px-0",attrs:{fluid:""}},[i("p",{staticClass:"text-left my-0"},[t._v(t._s(t.active.size)+"/"+t._s(t.limit))]),t._v(" "),i("v-row",{attrs:{dense:""}},t._l(t.currentPage,(function(e,a){return i("v-col",{key:a,attrs:{cols:"6",xs:"6",lg:"2"}},[i("v-card",{staticClass:"overflow-hidden",on:{click:function(i){t.active.has(e.id)?t.removePic(e.id):t.addPic(e.id)}}},[i("v-img",{staticClass:"image",attrs:{src:e.path,height:"80px",width:"auto",cover:""}}),t._v(" "),t.active.has(e.id)?i("v-icon",{staticClass:"image__icon success lighten-1"},[t._v("mdi-check")]):t._e()],1)],1)})),1),t._v(" "),i("v-card-actions",[i("v-btn",{staticClass:"primary",attrs:{type:"submit"},on:{click:t.save}},[t._v("ZAPISZ")]),t._v(" "),i("v-spacer"),t._v(" "),i("v-btn",{on:{click:t.previousPage}},[i("v-icon",[t._v("mdi-arrow-left")])],1),t._v(" "),i("v-btn",{on:{click:t.nextPage}},[i("v-icon",[t._v("mdi-arrow-right")])],1)],1)],1):t._e()};a._withStripped=!0;var s={props:["value","limit","maxDisplayed","selected"],data:()=>({pageNum:0,active:null}),computed:{images(){return new Set(this.value)},currentPage(){return[...this.value].slice(this.pageNum*this.maxDisplayed,this.pageNum*this.maxDisplayed+this.maxDisplayed).map(t=>t)}},mounted(){this.active=new Set(this.$props.selected)},methods:{nextPage(){this.pageNum+1<this.images.size/this.maxDisplayed&&this.pageNum++},previousPage(){this.pageNum>0&&this.pageNum--},save(){this.$emit("submit",this.active)},addPic(t){1===this.active.size&&1===this.limit&&(this.active=new Set),this.active.size<this.limit&&(this.active=new Set(this.active.add(t)))},removePic(t){this.active.delete(t),this.active=new Set(this.active)}},watch:{selected(t,e){this.active=new Set(t)}}},n=(i(52),i(0)),c=Object(n.a)(s,a,[],!1,null,"346c8138",null);c.options.__file="client/src/components/app-image-picker.vue";e.a=c.exports},68:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.content?i("main",[i("h1",{attrs:{contenteditable:t.admin},domProps:{innerHTML:t._s(t.content.zabieg.name)},on:{blur:t.updateName}}),t._v(" "),t.content.zabieg.image?i("v-img",{attrs:{src:t.content.zabieg.image.path,width:"400px",height:"450px",cover:""}}):t._e(),t._v(" "),t.admin&&t.images?i("app-image-picker",{attrs:{value:t.images,limit:1,maxDisplayed:24,selected:t.content.zabieg.image?[t.content.zabieg.image.id]:[]},on:{submit:t.updateImg}}):t._e(),t._v(" "),i("app-editable-content",{key:t.content.zabieg.id,on:{save:t.save},model:{value:t.content.zabieg.description,callback:function(e){t.$set(t.content.zabieg,"description",e)},expression:"content.zabieg.description"}}),t._v(" "),i("p",[t._v("Czas trwania: "+t._s(t.content.zabieg.duration))])],1):t._e()};a._withStripped=!0;var s=i(53),n=i(4),c={components:{appImagePicker:s.a},data:()=>({content:null}),computed:{...Object(n.b)({images:t=>t.admin.images||[]}),title(){return this.content.zabieg.name||"Zabieg"},name(){return this.$route.params.name||!1},category(){return this.$route.params.category||!1},admin(){return this.$store.getters["auth/getRole"]("ROLE_ADMIN")}},async created(){this.name&&this.category&&(this.content=await this.$http.fetchData(`/api/zabieg/${this.category}/${this.name}`),this.changeTitle())},methods:{updateImg(t){try{t=[...t],this.content.zabieg.image=this.images.find(e=>e.id===t[0])}catch(t){this.content.zabieg.image=null}finally{this.save()}},updateName(t){this.content.zabieg.name=t.target.innerText,this.save()},save(){this.$http.saveTreatment(this.content.zabieg)}}},r=i(0),o=Object(r.a)(c,a,[],!1,null,null,null);o.options.__file="client/src/views/Trychologia.vue";e.default=o.exports}}]);