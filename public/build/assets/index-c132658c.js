import{c as r,w as i,o as s,a as t,e as o,h as d,t as a,F as l,f as p}from"./app-4d164279.js";import{_ as x}from"./AppLayout-ad8e5f49.js";/* empty css            */import"./_plugin-vue_export-helper-c27b6911.js";const _=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Transactions ",-1),h={class:"py-12"},m={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},g={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"},u={class:"min-w-full divide-y divide-gray-200"},y=t("thead",null,[t("tr",null,[t("th",{scope:"col",class:"px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Name "),t("th",{scope:"col",class:"px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Amount "),t("th",{scope:"col",class:"px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Description "),t("th",{scope:"col",class:"px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"}," Date ")])],-1),w={class:"bg-white divide-y divide-gray-200"},f={class:"px-6 py-4 whitespace-nowrap"},b={class:"px-6 py-4 whitespace-nowrap"},k={class:"px-6 py-4 whitespace-nowrap"},v={class:"px-6 py-4 whitespace-nowrap text-sm font-medium"},N={key:0,class:"text-center"},B=t("td",{colspan:"4"},"No Has Realizado Ninguna Transaction",-1),D=[B],E={__name:"index",props:{user:{},transactions:[]},setup(c){return(T,C)=>(s(),r(x,{title:"Transactions"},{header:i(()=>[_]),default:i(()=>[t("div",h,[t("div",m,[t("div",g,[t("table",u,[y,t("tbody",w,[(s(!0),o(l,null,d(c.transactions.data,(e,n)=>(s(),o("tr",{key:n},[t("td",f,a(e.name),1),t("td",b,a(e.amount),1),t("td",k,a(e.description),1),t("td",v,a(e.created_at),1)]))),128)),c.transactions.data.lenght<=0?(s(),o("tr",N,D)):p("",!0)])])])])])]),_:1}))}};export{E as default};
