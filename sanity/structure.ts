import type {StructureResolver} from 'sanity/structure'

export const structure: StructureResolver = (S) =>
  S.list()
    .title('Content')
    .items([
      S.listItem()
        .title('Site Settings')
        .id('siteSettingsSingleton')
        .child(
          S.document()
            .schemaType('siteSettings')
            .documentId('siteSettings')
            .title('Site Settings'),
        ),
      S.divider(),
      S.listItem()
        .title('Pages')
        .child(S.documentTypeList('page').title('Pages').defaultOrdering([{field: 'title', direction: 'asc'}])),
      S.listItem()
        .title('Services')
        .child(
          S.documentTypeList('service')
            .title('Services')
            .defaultOrdering([{field: 'displayOrder', direction: 'asc'}]),
        ),
      S.listItem()
        .title('Portfolio')
        .child(
          S.list()
            .title('Portfolio')
            .items([
              S.listItem()
                .title('Items')
                .child(
                  S.documentTypeList('portfolioItem')
                    .title('Portfolio Items')
                    .defaultOrdering([{field: 'publishedAt', direction: 'desc'}]),
                ),
              S.listItem()
                .title('Categories')
                .child(
                  S.documentTypeList('portfolioCategory')
                    .title('Portfolio Categories')
                    .defaultOrdering([{field: 'displayOrder', direction: 'asc'}]),
                ),
            ]),
        ),
      S.listItem()
        .title('Testimonials')
        .child(
          S.documentTypeList('testimonial')
            .title('Testimonials')
            .defaultOrdering([{field: 'displayOrder', direction: 'asc'}]),
        ),
    ])
