/* Define a Student Service */
export interface IStudentService {
    permalink: string;
    heading: string;
    title: string;
    main_category: string;
    main_category_name: string;
    main_category_link: string;
    short_descr: string;
    long_descr: string;
    gallery: {
      flickr: string;
    };
    additional: [
        {
        title: string;
        url: string;
        descr: string;
      }
    ];
    image: string;
    image_alt: string;
    image_thumbnail_src: string;
    primary_action: string;
    primary_action_url: string;
    campaign: string;
    phone: string;
    email: string;
    url: string;
    location: string;
    hours_monday: string;
    hours_tuesday: string;
    hours_wednesday: string;
    hours_thursday: string;
    hours_friday: string;
    hours_saturday: string;
    hours_sunday: string;
    social_facebook: string;
    social_twitter: string;
    social_youtube: string;
    social_googleplus: string;
    social_linkedin: string;
    social_instagram: string;
    social_pinterest: string;
    social_tumblr: string;
    social_flickr: string;
    events_cal_feed: string;
    map_id: string;
    news_feed: string;
    share_facebook: string;
    share_twitter: string;
}
