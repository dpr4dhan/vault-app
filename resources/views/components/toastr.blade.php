<div
    x-data="noticesHandler()"
    class="fixed inset-2 flex flex-col-reverse items-end justify-start h-screen w-screen"
    @notice.window="add($event.detail)"
    style="pointer-events:none">
    <template x-for="notice of notices" :key="notice.id">
        <div
            x-show="visible.includes(notice)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform translate-x-full opacity-0"
            @click="remove(notice.id)"
            class="rounded mb-4 mr-6 w-56  h-10 flex items-center justify-center text-white shadow-lg font-bold text-sm cursor-pointer"
            :class="{
				'bg-green-500': notice.type === 'success',
				'bg-blue-500': notice.type === 'info',
				'bg-orange-500': notice.type === 'warning',
				'bg-red-500': notice.type === 'error',
			 }"
            style="pointer-events:all"
            x-text="notice.text">
        </div>
    </template>
</div>
<script type="text/javascript">
    function noticesHandler() {
        return {
            notices: [],
            visible: [],
            add(notice) {
                notice.id = Date.now()
                this.notices.push(notice)
                this.fire(notice.id)
            },
            fire(id) {
                this.visible.push(this.notices.find(notice => notice.id == id))
                const timeShown = 2000 * this.visible.length
                setTimeout(() => {
                    this.remove(id)
                }, timeShown)
            },
            remove(id) {
                const notice = this.visible.find(notice => notice.id == id)
                const index = this.visible.indexOf(notice)
                this.visible.splice(index, 1)
            },
        }
    }

</script>
