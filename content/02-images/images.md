Title: Images

----

[Subtitle:]

----

[Description:]

----

Keywords: images

----

[Intro:]

----

Text:

All photos on this page are from [Unsplash](http://unsplash.com).

## Image tag

(image: unsplash_525b54bcc32ba_1.jpg width: 450)

*Default Kirby image tag --- link to original image*

---

## Thumb tag

(thumb: unsplash_525b54bcc32ba_1.jpg width: 225 height: 225 quality: 75 alt: Thumb, quality 75)
(thumb: unsplash_525b54bcc32ba_1.jpg width: 225 height: 225 alt: Thumb)

*Thumb tag --- both height and width are set.*

(thumb: unsplash_525b54bcc32ba_1.jpg width: 400 height: 250 crop: true hd: false alt: Thumb no HD)
(thumb: unsplash_525b54bcc32ba_1.jpg width: 400 height: 250 crop: true alt: Thumb HD cropped)

*Thumb tag --- both height and width are set, plus crop is set to true (hd is set to false for the left image).*

---

## Figure tag

(figure: unsplash_525b54bcc32ba_1.jpg width: 450 quality: 80 hd: false caption: Optional image caption)
(figure: unsplash_525b54bcc32ba_1.jpg width: 450 quality: 55 caption: Optional image caption)

*Figure tag --- image quality set to 80, but hd is false (**top**), image quality is set to 60 and hd is true (**bottom**).*

----

Multi figure:

## Multi-figure tag

(figure: unsplash_5259a4d21eceb_1.jpg quality: 55 hd: true)
(multifigure: unsplash_52585c3dd6b34_1.jpg | unsplash_52850d6938211_1.jpg | unsplash_5248748fb40ac_1.jpg width: 1of3 | 1of3 | 1of3 hd: true)
(multifigure: unsplash_526360a842e20_1.jpg | unsplash_568gh845d584s_1.jpg width: 1of2 | 1of2 breakfrom: compact hd: true)
(multifigure: unsplash_527e842bc0615_1.jpg | unsplash_5243e9ef164a5_1.jpg width: 2of3 | 1of3 hd: true)
(multifigure: unsplash_5245b69bc5330_1.jpg | unsplash_5252bb51404f8_1.jpg width: 1of3 | 2of3 breakfrom: compact)

*Multifigure tag --- multiple images within a figure element, and an array of layout configurations.*

----

Imgrid:

## Image grid tag

(imgrid: unsplash_5263607dd1bfc_1.jpg | unsplash_5263605581e32_1.jpg | unsplash_5255beab37be0_1.jpg | unsplash_5287d4367585d_1.jpg | unsplash_5249ec183ab2c_1.jpg | unsplash_52424d6a9e278_1.jpg | unsplash_5263607dd1bfc_1.jpg | unsplash_525f012329589_1.jpg | unsplash_525d7892901ff_1.jpg | unsplash_5255bf45a4a45_1.jpg | unsplash_5261cd0183e57_1.jpg per-row: 3 caption: Optional image caption)

*Imgrid tag --- multiple images within a figure element, in a Google+ style grid layout, and an array of layout configurations.*

----

Slider:

## Slider tag

(slider: unsplash_5263605581e32_1.jpg | unsplash_5252bb51404f8_1.jpg | unsplash_5243e9ef164a5_1.jpg width: 600 height: 400)
