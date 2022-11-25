export function initDynamicPagination(swiper) {

    console.log(swiper)

    const pagination = swiper.pagination

    if (pagination && typeof pagination.bullets !== 'undefined') {

        const bullets = Object.values(pagination.bullets).filter(bullet => bullet instanceof Element)

        const totalBullets = bullets.length

        if (totalBullets > 5) {
            const maxIndex = totalBullets - 1
            const activeIndex = bullets.findIndex((bullet, i) => bullet.classList.contains('swiper-pagination-bullet-active'))

            const visibleIndexes = [activeIndex];

            for (let i = 1; i < 3; i++) {
                let index, currentIndex = activeIndex + i;

                if (currentIndex >= maxIndex) {
                    index = currentIndex - maxIndex
                } else {
                    index = currentIndex
                }
                visibleIndexes.push(index)
            }

            for (let i = 1; i < 3; i++) {
                let index, currentIndex = activeIndex - i;

                if (currentIndex < 0) {
                    index = maxIndex + currentIndex + 1
                } else {
                    index = currentIndex
                }
                visibleIndexes.push(index)
            }

            $(bullets).each((index, bullet) => {
                if (visibleIndexes.includes(index)) {
                    $(bullet).addClass('visible').show()
                } else {
                    $(bullet).removeClass('visible').hide()
                }
            })
        }
    }
}
