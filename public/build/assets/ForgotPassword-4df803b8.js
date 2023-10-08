import{T as d,e as l,b as e,u as t,w as o,F as c,o as m,Z as f,t as _,f as p,a,n as w,g,k as b}from"./app-4d164279.js";import{A as y}from"./AuthenticationCard-0a7f31f5.js";import{_ as x}from"./AuthenticationCardLogo-cf8ddea3.js";import{_ as h}from"./InputError-3b192992.js";import{_ as k}from"./InputLabel-d235ffb0.js";import{_ as V}from"./PrimaryButton-73fe5205.js";import{_ as v}from"./TextInput-89c63541.js";/* empty css            */import"./_plugin-vue_export-helper-c27b6911.js";const F=a("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$=["onSubmit"],C={class:"flex items-center justify-end mt-4"},J={__name:"ForgotPassword",props:{status:String},setup(r){const s=d({email:""}),n=()=>{s.post(route("password.email"))};return(S,i)=>(m(),l(c,null,[e(t(f),{title:"Forgot Password"}),e(y,null,{logo:o(()=>[e(x)]),default:o(()=>[F,r.status?(m(),l("div",N,_(r.status),1)):p("",!0),a("form",{onSubmit:b(n,["prevent"])},[a("div",null,[e(k,{for:"email",value:"Email"}),e(v,{id:"email",modelValue:t(s).email,"onUpdate:modelValue":i[0]||(i[0]=u=>t(s).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(h,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),a("div",C,[e(V,{class:w({"opacity-25":t(s).processing}),disabled:t(s).processing},{default:o(()=>[g(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{J as default};
