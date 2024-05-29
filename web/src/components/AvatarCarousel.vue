<template>
  <div class="avatar-carousel">
    <button @click="prevGroup" :disabled="currentGroup === 0">Prev</button>
    <div class="avatars">
      <div v-for="(avatar, index) in currentAvatars" :key="index" :class="{ selected: selectedAvatar === avatar }"
        @click="selectAvatar(avatar)" class="avatar">
        <img :src="avatar" alt="Avatar" />
      </div>
    </div>
    <button @click="nextGroup" :disabled="currentGroup === totalGroups - 1">Next</button>
  </div>
</template>

<script>
import avatar1 from '@/assets/profileAvatarCollection/avatar1.svg';
import avatar2 from '@/assets/profileAvatarCollection/avatar2.svg';
import avatar3 from '@/assets/profileAvatarCollection/avatar3.svg';
import avatar4 from '@/assets/profileAvatarCollection/avatar4.svg';
import avatar5 from '@/assets/profileAvatarCollection/avatar5.svg';
import avatar6 from '@/assets/profileAvatarCollection/avatar6.svg';
import avatar7 from '@/assets/profileAvatarCollection/avatar7.svg';
import avatar8 from '@/assets/profileAvatarCollection/avatar8.svg';
import avatar9 from '@/assets/profileAvatarCollection/avatar9.svg';
import avatar10 from '@/assets/profileAvatarCollection/avatar10.svg';
import avatar11 from '@/assets/profileAvatarCollection/avatar11.svg';
import avatar12 from '@/assets/profileAvatarCollection/avatar12.svg';
import avatar13 from '@/assets/profileAvatarCollection/avatar13.svg';
import avatar14 from '@/assets/profileAvatarCollection/avatar14.svg';
import avatar15 from '@/assets/profileAvatarCollection/avatar15.svg';
import avatar16 from '@/assets/profileAvatarCollection/avatar16.svg';
import avatar17 from '@/assets/profileAvatarCollection/avatar17.svg';
import avatar18 from '@/assets/profileAvatarCollection/avatar18.svg';
import avatar19 from '@/assets/profileAvatarCollection/avatar19.svg';
import avatar20 from '@/assets/profileAvatarCollection/avatar20.svg';
import avatar21 from '@/assets/profileAvatarCollection/avatar21.svg';
import avatar22 from '@/assets/profileAvatarCollection/avatar22.svg';
import avatar23 from '@/assets/profileAvatarCollection/avatar23.svg';
import avatar24 from '@/assets/profileAvatarCollection/avatar24.svg';
import avatar25 from '@/assets/profileAvatarCollection/avatar25.svg';
import avatar26 from '@/assets/profileAvatarCollection/avatar26.svg';
import avatar27 from '@/assets/profileAvatarCollection/avatar27.svg';
import avatar28 from '@/assets/profileAvatarCollection/avatar28.svg';
import avatar29 from '@/assets/profileAvatarCollection/avatar29.svg';
import avatar30 from '@/assets/profileAvatarCollection/avatar30.svg';
import avatar31 from '@/assets/profileAvatarCollection/avatar31.svg';
import avatar32 from '@/assets/profileAvatarCollection/avatar32.svg';
import avatar33 from '@/assets/profileAvatarCollection/avatar33.svg';
import avatar34 from '@/assets/profileAvatarCollection/avatar34.svg';
import avatar35 from '@/assets/profileAvatarCollection/avatar35.svg';
import avatar36 from '@/assets/profileAvatarCollection/avatar36.svg';
import avatar37 from '@/assets/profileAvatarCollection/avatar37.svg';
import avatar38 from '@/assets/profileAvatarCollection/avatar38.svg';
import avatar39 from '@/assets/profileAvatarCollection/avatar39.svg';
import avatar40 from '@/assets/profileAvatarCollection/avatar40.svg';
import avatar41 from '@/assets/profileAvatarCollection/avatar41.svg';
import avatar42 from '@/assets/profileAvatarCollection/avatar42.svg';
import avatar43 from '@/assets/profileAvatarCollection/avatar43.svg';
import avatar44 from '@/assets/profileAvatarCollection/avatar44.svg';
import avatar45 from '@/assets/profileAvatarCollection/avatar45.svg';
import avatar46 from '@/assets/profileAvatarCollection/avatar46.svg';
import avatar47 from '@/assets/profileAvatarCollection/avatar47.svg';
import avatar48 from '@/assets/profileAvatarCollection/avatar48.svg';
import avatar49 from '@/assets/profileAvatarCollection/avatar49.svg';
import avatar50 from '@/assets/profileAvatarCollection/avatar50.svg';
import avatar51 from '@/assets/profileAvatarCollection/avatar51.svg';
import avatar52 from '@/assets/profileAvatarCollection/avatar52.svg';
import avatar53 from '@/assets/profileAvatarCollection/avatar53.svg';
import avatar54 from '@/assets/profileAvatarCollection/avatar54.svg';
import avatar55 from '@/assets/profileAvatarCollection/avatar55.svg';
import avatar56 from '@/assets/profileAvatarCollection/avatar56.svg';
import avatar57 from '@/assets/profileAvatarCollection/avatar57.svg';

export default {
  name: "AvatarCarousel",
  props: {
    value: String
  },
  data() {
    return {
      avatars: [
        avatar1, avatar2, avatar3, avatar4, avatar5, avatar6, avatar7, avatar8, avatar9, avatar10,
        avatar11, avatar12, avatar13, avatar14, avatar15, avatar16, avatar17, avatar18, avatar19, avatar20,
        avatar21, avatar22, avatar23, avatar24, avatar25, avatar26, avatar27, avatar28, avatar29, avatar30,
        avatar31, avatar32, avatar33, avatar34, avatar35, avatar36, avatar37, avatar38, avatar39, avatar40,
        avatar41, avatar42, avatar43, avatar44, avatar45, avatar46, avatar47, avatar48, avatar49, avatar50,
        avatar51, avatar52, avatar53, avatar54, avatar55, avatar56, avatar57
      ],
      selectedAvatar: this.value,
      currentGroup: 0,
      itemsPerGroup: 5
    };
  },
  computed: {
    totalGroups() {
      return Math.ceil(this.avatars.length / this.itemsPerGroup);
    },
    currentAvatars() {
      const start = this.currentGroup * this.itemsPerGroup;
      const end = start + this.itemsPerGroup;
      return this.avatars.slice(start, end);
    }
  },
  methods: {
    selectAvatar(avatar) {
      this.selectedAvatar = avatar;
      this.$emit("avatar-selected", avatar.slice(avatar.lastIndexOf('/') + 1));
      console.log(avatar);
    },
    prevGroup() {
      if (this.currentGroup > 0) {
        this.currentGroup--;
      }
    },
    nextGroup() {
      if (this.currentGroup < this.totalGroups - 1) {
        this.currentGroup++;
      }
    }
  }
};
</script>

<style scoped>
.avatar-carousel {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.avatars {
  display: flex;
  gap: 1rem;
}

.avatar {
  cursor: pointer;
}

.avatar.selected {
  border: 2px solid white;
}

.avatar img {
  width: 72px;
  height: 72px;
  object-fit: cover;
  border-radius: 50%;
}

button {
  padding: .5rem 1.25rem;
  width: fit-content;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
  transition: background-color .2s ease-in-out;
}

button:hover {
  cursor: pointer;
  background-color: var(--color-border-hover);
}

button:disabled {
  background-color: var(--color-border-hover);
  cursor: not-allowed;
}
</style>
