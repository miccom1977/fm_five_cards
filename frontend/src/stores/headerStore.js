import { defineStore } from 'pinia';
import useSessionStorage from '@/composables/useSessionStorage'; 

export const useHeaderStore = defineStore('header', {
  state: ()=>({
    username: useSessionStorage('username', ''),
    level: useSessionStorage('level', ''),
    levelPoints: useSessionStorage('levelPoints', ''),
    nextLevelPoints: useSessionStorage('nextLevelPoints', '')
  }),
  actions: {
    updateUser(data) {
      this.username = data.username;
      this.level = data.level;
      this.levelPoints = data.level_points;
      this.nextLevelPoints = data.next_level_points;
    },
  }
});