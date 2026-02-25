import {defineField, defineType} from 'sanity'

export const service = defineType({
  name: 'service',
  title: 'Service',
  type: 'document',
  fields: [
    defineField({
      name: 'title',
      title: 'Title',
      type: 'string',
      validation: (Rule) => Rule.required().max(90),
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
      name: 'summary',
      title: 'Summary',
      type: 'text',
      rows: 3,
      validation: (Rule) => Rule.required().max(280),
    }),
    defineField({
      name: 'headline',
      title: 'Hero Headline',
      type: 'string',
      validation: (Rule) => Rule.required().max(160),
    }),
    defineField({
      name: 'hero',
      title: 'Hero',
      type: 'heroMedia',
      validation: (Rule) => Rule.required(),
    }),
    defineField({
      name: 'description',
      title: 'Description',
      type: 'array',
      of: [{type: 'block'}],
      validation: (Rule) => Rule.required(),
    }),
    defineField({
      name: 'keyBenefits',
      title: 'Key Benefits',
      type: 'array',
      of: [{type: 'benefitItem'}],
      validation: (Rule) => Rule.max(8),
    }),
    defineField({
      name: 'featuredPortfolio',
      title: 'Featured Portfolio',
      type: 'array',
      of: [
        {
          type: 'reference',
          to: [{type: 'portfolioItem'}],
        },
      ],
      validation: (Rule) => Rule.max(6),
    }),
    defineField({
      name: 'seo',
      title: 'SEO',
      type: 'seo',
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
      media: 'hero.image',
    },
    prepare({title, subtitle, media}) {
      return {
        title,
        subtitle: subtitle ? `/${subtitle}` : 'No slug',
        media,
      }
    },
  },
})
