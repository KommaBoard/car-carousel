var Arbiter=function(){var n=function(){var r={},e={},t={},s={},u=1;return{version:"1.0",updated_on:"2011-12-19",create:function(){return n()},subscribe:function(){var n,i,a,c,f,o,l,p,b={},g=!1,h=0,m=[];if(arguments.length<2)return null;i=arguments[0],o=arguments[arguments.length-1],arguments.length>2&&(b=arguments[1]||{}),arguments.length>3&&(l=arguments[2]),b.priority&&(h=b.priority),"string"==typeof i&&(i=i.split(/[,\s]+/));for(var v=0;v<i.length;v++)if(n=i[v],/\*$/.test(n)?(g=!0,n=n.replace(/\*$/,""),a=e[n],a||(e[n]=a=[])):(a=r[n],a||(r[n]=a=[])),p=u++,f={id:p,f:o,p:h,self:l,options:b},s[p]=f,a.push(f),a=a.sort(function(n,r){return n.p>r.p?-1:n.p==r.p?0:1}),g?e[n]=a:r[n]=a,m.push(p),!b.persist&&t[n]){c=t[n];for(var d=0;d<c.length;d++)f.f.call(f.self,c[d],{persist:!0})}return i.length>0?m:m[0]},publish:function(n,s,u){var i,a,c,f=10,o=!0,l=!0,p={},b=r[n]||[];u=u||{};for(c in e)0==n.indexOf(c)&&(b=b.concat(e[c]));if(u.persist===!0&&(t[n]||(t[n]=[]),t[n].push(s)),0==b.length)return o;"boolean"==typeof u.cancelable&&(l=u.cancelable);for(var g=0;g<b.length;g++)if(a=b[g],!a.unsubscribed)try{if(u.async===!0||a.options&&a.options.async)setTimeout(function(r){return function(){r.f.call(r.self,s,n,p)}}(a),f++);else if(i=a.f.call(a.self,s,n,p),l&&i===!1)break}catch(h){o=!1}return o},unsubscribe:function(n){return s[n]?(s[n].unsubscribed=!0,!0):!1},resubscribe:function(n){return s[n]?(s[n].unsubscribed=!1,!0):!1}}};return n()}();