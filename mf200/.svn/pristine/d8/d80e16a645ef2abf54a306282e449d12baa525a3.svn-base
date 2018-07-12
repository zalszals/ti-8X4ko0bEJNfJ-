<template>
  <div class="hello" @click='aaa'>
    {{msg}}
  </div>
</template>

<script>
export default {
  name: 'Header',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  methods: {
    aaa: function (){
      $.ajax({
        url:'/index.html',
        success: function (re){
          layer.open({
            type: 2,
            title: 'layer mobile页',
            shadeClose: true,
            shade: 0.4,
            area: ['800px', '50%'],
            content: '/#/baseset/growlist' //iframe的url
          })
        }
      })
    } 
  } 
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
