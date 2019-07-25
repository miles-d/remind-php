# REMIND

NOTE: this project is currently developed outside of github.  Considered it archived.

This is the source code of [remind.miloszdragan.pl](http://remind.miloszdragan.pl)

Remind is a PHP web-app that aids learning. It is a tool to schedule reviews of
learning topics using spaced-repetition scheme. All it does is tell you when you
should review your materials.

## Review topics

Good candidates for material topic are:
- Wikipedia articles
- Blog posts
- Pieces of documentation
- Personal notes on a specific topic
- Short videos like screencasts or Khan Academy videos
- ...

'Topic' as understood by REMIND is just a description of actual item to learn, e.g.:

    "Wikipedia article on Circadian rhythm"
    "My notes on Schneier's 'Data and Goliath'"
    "PHPUnit documentation"

After adding a topic, it is scheduled to review for the following day. On that day,
this topic will be highlighted on the home page. After clicking on that topic, an
option "Mark Reviewed" is available; this schedules the next review to next week,
then month, etc.

## Review scheduling

Spaced-repetition used in REMINDS is very simple. Reviews are scheduled to:

- the next day (first review)
- next week
- next month
- next 3 months
- next 6 months
- next year

After the 6th review, the topic is considered mastered and will not be rescheduled
anymore.
