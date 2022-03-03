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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                title: 'New Soft Soffa ',
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
                button: {
                    text: 'Shop Now',
                    url: false,
                    class: 'btn btn-medium btn-primary'
                }
            }
        ]

    });

});
