import {defineField, defineType} from 'sanity'

export const testimonial = defineType({
  name: 'testimonial',
  title: 'Testimonial',
  type: 'document',
  fields: [
    defineField({
      name: 'quote',
      title: 'Quote',
      type: 'text',
      rows: 4,
      validation: (Rule) => Rule.required().min(20).max(400),
    }),
    defineField({
      name: 'name',
      title: 'Name',
      type: 'string',
      validation: (Rule) => Rule.required().max(80),
    }),
    defineField({
      name: 'role',
      title: 'Role / Title',
      type: 'string',
      validation: (Rule) => Rule.max(80),
    }),
    defineField({
      name: 'company',
      title: 'Company',
      type: 'string',
      validation: (Rule) => Rule.max(120),
    }),
    defineField({
      name: 'avatar',
      title: 'Avatar',
      type: 'image',
      options: {hotspot: true},
    }),
    defineField({
      name: 'relatedService',
      title: 'Related Service',
      type: 'reference',
      to: [{type: 'service'}],
    }),
    defineField({
      name: 'featured',
      title: 'Featured',
      type: 'boolean',
      initialValue: true,
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
      title: 'name',
      role: 'role',
      company: 'company',
      media: 'avatar',
    },
    prepare({title, role, company, media}) {
      const subtitle = [role, company].filter(Boolean).join(' at ')
      return {
        title,
        subtitle: subtitle || 'Testimonial',
        media,
      }
    },
  },
})
