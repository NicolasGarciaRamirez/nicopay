import{T as l,d,e as c,b as o,u as e,w as r,F as p,o as u,Z as f,a,n as _,g as w,k as b}from"./app-4d164279.js";import{A as g}from"./AuthenticationCard-0a7f31f5.js";import{_ as h}from"./AuthenticationCardLogo-cf8ddea3.js";import{_ as x}from"./InputError-3b192992.js";import{_ as v}from"./InputLabel-d235ffb0.js";import{_ as y}from"./PrimaryButton-73fe5205.js";import{_ as V}from"./TextInput-89c63541.js";/* empty css            */import"./_plugin-vue_export-helper-c27b6911.js";const k=a("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),C=["onSubmit"],$={class:"flex justify-end mt-4"},E={__name:"ConfirmPassword",setup(A){const s=l({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(B,i)=>(u(),c(p,null,[o(e(f),{title:"Secure Area"}),o(g,null,{logo:r(()=>[o(h)]),default:r(()=>[k,a("form",{onSubmit:b(n,["prevent"])},[a("div",null,[o(v,{for:"password",value:"Password"}),o(V,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=m=>e(s).password=m),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),o(x,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),a("div",$,[o(y,{class:_(["ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,C)]),_:1})],64))}};export{E as default};
