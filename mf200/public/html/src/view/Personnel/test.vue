<template>
<div @click="aaa(1)">
	{{s}}
</div>
</template>
<style scoped>


</style>
<style>


</style>

<script>
	export default {
		data() {
			return {
				s: 0
			}
		},
		methods: {
			cliaaa: function(a) {
				swal("确认不通过", {
					buttons: ["取消", "确认"],
				})

			}
		}
	}

</script>
