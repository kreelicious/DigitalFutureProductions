import {defineField, defineType} from 'sanity'

export const navItem = defineType({
  name: 'navItem',
  title: 'Navigation Item',
  type: 'object',
  fields: [
    defineField({
      name: 'label',
      title: 'Label',
      type: 'string',
      validation: (Rule) => Rule.required().max(40),
    }),
    defineField({
      name: 'href',
      title: 'Link Path',
      type: 'string',
      description: 'Use internal paths like /portfolio or /services/weddings.',
      validation: (Rule) =>
        Rule.required().custom((value) => {
          if (!value) return true
          return value.startsWith('/') ? true : 'Path should start with /.'
        }),
    }),
    defineField({
      name: 'newTab',
      title: 'Open In New Tab',
      type: 'boolean',
      initialValue: false,
    }),
  ],
  preview: {
    select: {
      title: 'label',
      subtitle: 'href',
    },
  },
})
