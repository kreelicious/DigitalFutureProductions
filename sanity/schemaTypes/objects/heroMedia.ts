import {defineField, defineType} from 'sanity'

export const heroMedia = defineType({
  name: 'heroMedia',
  title: 'Hero Media',
  type: 'object',
  fields: [
    defineField({
      name: 'mediaType',
      title: 'Media Type',
      type: 'string',
      initialValue: 'image',
      options: {
        list: [
          {title: 'Image', value: 'image'},
          {title: 'Video (Vimeo)', value: 'video'},
        ],
        layout: 'radio',
      },
      validation: (Rule) => Rule.required(),
    }),
    defineField({
      name: 'image',
      title: 'Hero Image',
      type: 'image',
      options: {hotspot: true},
      fields: [
        defineField({
          name: 'alt',
          title: 'Alt Text',
          type: 'string',
          validation: (Rule) => Rule.max(140),
        }),
      ],
      hidden: ({parent}) => parent?.mediaType === 'video',
      validation: (Rule) =>
        Rule.custom((value, context) => {
          if ((context.parent as {mediaType?: string})?.mediaType === 'image' && !value) {
            return 'Hero image is required when media type is image.'
          }
          return true
        }),
    }),
    defineField({
      name: 'vimeoId',
      title: 'Vimeo Video ID',
      type: 'string',
      description: 'Example: 123456789',
      hidden: ({parent}) => parent?.mediaType !== 'video',
      validation: (Rule) =>
        Rule.custom((value, context) => {
          if ((context.parent as {mediaType?: string})?.mediaType === 'video' && !value) {
            return 'Vimeo ID is required when media type is video.'
          }
          return true
        }),
    }),
    defineField({
      name: 'poster',
      title: 'Video Poster Image',
      type: 'image',
      description: 'Used before loading Vimeo player.',
      options: {hotspot: true},
      hidden: ({parent}) => parent?.mediaType !== 'video',
    }),
    defineField({
      name: 'overlayOpacity',
      title: 'Overlay Opacity',
      type: 'number',
      initialValue: 0.45,
      validation: (Rule) => Rule.min(0).max(1),
    }),
  ],
  preview: {
    select: {
      mediaType: 'mediaType',
      image: 'image',
      poster: 'poster',
      vimeoId: 'vimeoId',
    },
    prepare({mediaType, image, poster, vimeoId}) {
      const title = mediaType === 'video' ? `Video: ${vimeoId || 'missing ID'}` : 'Image Hero'
      return {
        title,
        subtitle: mediaType === 'video' ? 'Vimeo' : 'Image',
        media: mediaType === 'video' ? poster : image,
      }
    },
  },
})
