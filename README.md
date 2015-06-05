# meme_generator
Slack command that creates a meme from text

# Meme Generator

This PHP script allows you to generate an image, by using the API from [imgflip.com], and publish it to a Slack channel.
This script receives the following parameters:
  - **command**:       this token is generated when configuring a new command in Slack integrations
  - **token**:       this token is generated when configuring a new command in Slack integrations
  - **username**:   from the user that used the command
  - **channel**:    the channel where the user is chatting
  - **text**:       everything that comes right after the command "/meme". Below you'll find more detail about this format.

### Slack configuration
The first step is to create a new slack command, which can be done in .

### Parsing parameters from Slack
Markdown is a lightweight markup language based on the formatting conventions that people naturally use in email.  As [John Gruber] writes on the [Markdown site] [1]:

```sh
Slack: /meme [meme ID/meme pattern], [top-text], [bottom-text],[Channel ID]
```

> The overriding design goal for Markdown's
> formatting syntax is to make it as readable
> as possible. The idea is that a
> Markdown-formatted document should be
> publishable as-is, as plain text, without
> looking like it's been marked up with tags
> or formatting instructions.



### Version
3.0.2



### Installation

You need Gulp installed globally:

```sh
$ npm i -g gulp
```

```sh
$ git clone [git-repo-url] dillinger
$ cd dillinger
$ npm i -d
$ mkdir -p public/files/{md,html,pdf}
$ gulp build --prod
$ NODE_ENV=production node app
```

### Plugins

Dillinger is currently extended with the following plugins

* Dropbox
* Github
* Google Drive
* OneDrive

Readmes, how to use them in your own application can be found here:

* [plugins/dropbox/README.md](https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md)
* [plugins/github/README.md](https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md)
* [plugins/googledrive/README.md](https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md)
* [plugins/onedrive/README.md](https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md)


### Todo's

 - Write Tests
 - Rethink Github Save
 - Add Code Comments
 - Add Night Mode

License
----

MIT


**Free Software, Hell Yeah!**

[imgflip.com]:https://api.imgflip.com/ 