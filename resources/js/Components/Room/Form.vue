<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeTextarea from '@/Components/Textarea.vue';
import BreezeInputFile from '@/Components/InputFile.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import RoomImage from "@/Components/Room/Image.vue";
import { defineEmits, defineProps, ref, watch } from 'vue'

const props = defineProps({
  form: Object,
  buttonText: String
})

const emit = defineEmits(['submit'])

const submit = () => {
  emit('submit')
}

const deleteSubImage = (image_id) => {
  props.form.uploaded_sub_images.some((image, index) => {
    if (image.id == image_id) {
      props.form.delete_images.push(image);
      props.form.uploaded_sub_images.splice(index, 1);
    }
  })
}

const deleteThumbnail = (image) => {
  props.form.delete_images.push(image);
  props.form.uploaded_thumbnail = ""
}

const setSubImages = (e) => {
  if (e.target.files.length > (8 - props.form.uploaded_sub_images.length)) {
    alert('登録できる画像は合計8枚までです。')
    e.target.value = ""
  } else {
    props.form.sub_images = e.target.files;
  }
}

</script>

<template>

    <form @submit.prevent="submit">

      <div class="mb-6">
        <BreezeLabel for="title" value="客室名" />
        <BreezeInput id="title" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.title" required autocomplete="current-password" autofocus />
        <BreezeInputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="description" value="客室の説明" />
        <BreezeTextarea id="description" v-model="form.description"/>
        <BreezeInputError class="mt-2" :message="form.errors.description" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="room_size" value="広さ" />
        <BreezeInput id="room_size" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.room_size" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.room_size" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="min_capacity" value="定員" />
        <div class="flex items-center">
          <BreezeInput id="min_capacity" type="text" class="mt-1 block w-full bg-gray-50 w-24 mr-2" v-model="form.min_capacity" required autocomplete="current-password" /> - <BreezeInput type="text" class="mt-1 block w-full bg-gray-50 w-24 ml-2" v-model="form.max_capacity" required autocomplete="current-password" />
          <BreezeInputError class="mt-2" :message="form.errors.min_capacity" />
          <BreezeInputError class="mt-2" :message="form.errors.max_capacity" />
        </div>
      </div>
      <div class="mb-6">
        <BreezeLabel for="bed_type" value="ベッドタイプ" />
        <BreezeInput id="bed_type" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.bed_type" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.bed_type" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="facilities" value="その他の設備" />
        <BreezeTextarea id="facilities" v-model="form.facilities"/>
        <BreezeInputError class="mt-2" :message="form.errors.facilities" />
      </div>
      
      <div class="mb-6">
        <BreezeLabel for="thumbnail" value="アイキャッチ画像" />
        <BreezeInputFile @input="form.thumbnail = $event.target.files[0]" id="thumbnail" accept=".jpg, .jpeg, .png" v-if="!form.uploaded_thumbnail"/>
        <div v-else>アイキャッチ画像は1枚まで登録できます。新しい画像を登録する場合は既存の画像を削除してください。</div>
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help" v-if="!form.uploaded_thumbnail">一覧時と詳細ページの一番上に表示されます。</div>
        <BreezeInputError class="mt-2" :message="form.errors.thumbnail" />

        <div class="flex flex-wrap mt-4 mb-12" v-if="form.uploaded_thumbnail">
          <div
            class="basis-3/12"
          >
            <RoomImage :image-url="form.uploaded_thumbnail.image_url" :has-delete-button="true" @delete="deleteThumbnail(form.uploaded_thumbnail)" />
          </div>
        </div>
      </div>
      
      <div class="mb-6">
        <BreezeLabel for="sub_images" value="サブ画像" />
        <BreezeInputFile @change="setSubImages" id="sub_images" multiple  accept=".jpg, .jpeg, .png" :disabled="(Number(form.uploaded_sub_images.length) + Number(form.sub_images.length)) >= 8"/>
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">{{8 - Number(form.uploaded_sub_images.length)}}枚アップロード可能です。</div>

        <div class="flex flex-wrap mt-4 mb-12" v-if="form.uploaded_sub_images.length">
          <div
            v-for="image in form.uploaded_sub_images"
            :key="image.id"
            class="basis-3/12"
          >
            <RoomImage :image-url="image.image_url" :has-delete-button="true" @delete="deleteSubImage(image.id)" />
          </div>
        </div>
      </div>


      <div class="flex justify-center mt-8">
        <BreezeButton class="text-lg" v-text="buttonText">

        </BreezeButton>
      </div>
    </form>
</template>

