<template>
	<div class="media">
		<like-button :post="post" v-if="post.likedByCurrentUser === false && ($root.user.id !== post.user.id || post.canBeLikedByCurrentUser)"></like-button>
		<div class="media-left">
			<a href="#">
				<img class="media-object" v-bind:src="post.user.avatar" v-bind:alt="post.user.name">
			</a>
		</div>
		<div class="media-body">
			<strong>{{ post.user.name }}</strong>
			<p>{{ post.body }}</p>
			<p>{{ post.likeCount }} {{ pluralize('like', post.likeCount) }}</p>
		</div>
	</div>
</template>

<script>
	import LikeButton from './LikeButton.vue'
	import pluralize from 'pluralize'

	export default {
		props : [
			'post'
		],
		components: [
			LikeButton
		],
		methods : {
			pluralize
		}
	}
</script>

<style scoped>
	.media {
		position: relative;
		margin: 0;
		padding: 10px;
		border-bottom: 1px solid rgba(0, 0, 0, .03);
	}
	.media:hover .like {
		display: block;
	}
</style>