<template>
	<form action="#" class="form form-vertical" @submit.prevent="post">
		<div class="form-group">
			<textarea name="body" 
					  rows="4" 
					  class="form-control" 
					  placeholder="Write something likeable" 
					  v-model="body"
			></textarea>
		</div>
		<button class="btn btn-default">Post it!</button>
	</form>
</template>

<script>
	import eventHub from '../event'
	export default {
		data () {
			return {
				body : null
			}
		},
		methods: {
			post () {
				this.$http.post('posts', {
					body: this.body
				}).then((response) => {
					eventHub.$emit('post-added', response.body);
					this.body = null;
				})
			}
		}
	}
</script>