import {defineField, defineType} from 'sanity'

export const portfolioCategory = defineType({
  name: 'portfolioCategory',
  title: 'Portfolio Category',
  type: 'document',
  fields: [
    defineField({
      name: 'title',
      title: 'Title',
      type: 'string',
      validation: (Rule) => Rule.required().max(60),
    }),
    defineField({
      name: 'slug',
      title: 'Slug',
      type: 'slug',
      options: {
        source: 'title',
        maxLength: 96,
      },
      validation: (Rule) => Rule.required(),
    }),
    defineField({
      name: 'description',
      title: 'Description',
      type: 'text',
      rows: 2,
      validation: (Rule) => Rule.max(180),
    }),
    defineField({
      name: 'displayOrder',
      title: 'Display Order',
      type: 'number',
      initialValue: 100,
      validation: (Rule) => Rule.integer().min(1),
    }),
  ],
  preview: {
    select: {
      title: 'title',
      subtitle: 'slug.current',
    },
    prepare({title, subtitle}) {
      return {
        title,
        subtitle: subtitle ? `/${subtitle}` : 'No slug',
      }
    },
  },
})
