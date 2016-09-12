export interface ICalendarEvent {
    uid: number;
    summary: string;
    description: string;
    category: string;
    url: string;
    summerSession: string;
    isImportant: boolean;
    uniqueTag: string;
    dtstart: string;
    dtend: string;
    last_modified: string;
    tags: string[];
    directUrl: string;
}
