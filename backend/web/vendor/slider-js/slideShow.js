//animation list: flip, slice, box3D, pixel, fade, glide, card

$(document).ready(function () {

    $('#slideWiz').slideWiz({
        auto: true,
        speed: 3000,
        row: 12,
        col: 35,
        animation: [
            'flip',
            'slice',
            'box3D',
            'glide',
            'card'
        ],
        file: [
            {
                src: {
                    main: "../../image/silder/slider-2.jpg",
                    cover: "../../image/silder/slider-1.jpg"
                },
                title: 'Change Home Look',
                desc: "Make your home as comfortable and attractive as possible and then get on with living. There's more to life than decorating.",
                descLength: 220,
                button: {
                    text: 'Shop Now',
                    url: false,
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "../../image/silder/slider-6.jpg",
                    cover: "../../image/silder/slider-2.jpg"
                },
                title: 'Best Group Chair',
                desc: "Worrying is like a rocking chair, it gives you something to do, but it gets you nowhere. We're all just passing time and occupy our chair very briefly. If it's the right chair, it doesn't take too long to get comfortable in it. If they don't give you a seat at the table, bring a folding chair.",
                button: {
                    text: 'Shop Now',
                    url: false,
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "../../image/silder/slider-1.jpg",
                    cover: "../../image/silder/slider-3.jpg"
                },
                title: 'Best Look Chair',
                desc: "Decorate your home. It gives the illusion that your life is more interesting than it really is.",
                descLength: 190,
                button: {
                    text: 'Shop Now',
                    url: false,
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "../../image/silder/slider-2.jpg",
                    cover: "../../image/silder/slider-6.jpg"
                },
                title: 'New Soft Sofa ',
                desc: "I've always loved great upholstery, and think that a great sofa is one of the most important pieces of furniture in your home.",
                button: {
                    text: 'Shop Now',
                    url: false,
                    class: 'btn btn-medium btn-primary'
                }
            }
        ]

    });

});
