BoxConfig
========================
A (simple) site that allows developers to show their development environments off to the public. It allows you to add
your machines, (virtual) operatingsystems and software packages in an easy manner and see how others have configured
their systems. Find out how other developers similar to you develop, how you can improve your setup as well and get an
answer to the question what the most used hardware, or which PHP IDE is the most popular.


TODO List
========================

* [i] Paginate software
* [ ] Add comments to software / hardware / operating systems
* [ ] Friend users
* [ ] Add boxes / software / etc
* [ ] activation text and email texts should be in a decent layout
* [ ] email should be send to administrator when a new user has registered.
* [ ] resources can only be deleted if they are not in use
* [-] Create a twitter-type. This should be able to add <div class="input-prepend"><span class="add-on">@</span> in the form (already present in moopa)
* [ ] Matchenvironment widget should check matches based on environments (how do we calculate this?)
* [ ] Can we easily add fancyboxes for add/edit ?
* [ ] Do we even need messages? (if not, delete them)
* [ ] Let friends add kudos to the software you use, and comment on your configs
* [ ] Add comments to machines / environments
* [ ] Wizard style addition of data for users.
* [ ] Let user upload images to hardware/software/operatingsystems
* [ ] Add links that allow users to add hardware/software/OS
* [ ] View more in the top-widgets should point to a TOP-X page (paginated) page.
* [ ] Make sure that machine / environment matches up (ie: /box/machine/X/environment/Y)
* [ ] registration.flash.user_created should be translated
* [ ] When adding new hardware, the image of the hardware should be displayed (just like the gravatar images?)
* [ ] Implement user profile (/profile)
* [ ] fancybox always uses 75% now, make it so it autoscales to small window
* [ ] On password forget implementation, make sure we have a nice noticebar and the window closes automatically
* [ ] easy search through software
* [ ] wells and tabbars (and the span3's in the thumbnails) do not play along nicely (cannot use row/span12) (seems like you cannot use colspans in wells)


Done
----
* [X] Make sure users can register and login
* [X] setup firewalling
* [X] Make forgot password work
* [ ] Top widgets should be randomly chosen
* [X] Rename "sidebar" to "widget"
* [X] Add gravatar
* [X] During registration, check user/email through ajax. Give it a checkmark when it's ok.
* [X] add data fixtures
* [X] Active status on the menu items (how to set the "active" class) (add knpMenu or something)
* [X] Rename configuration into machine.
* [X] Box image is too large on the frontpage (get rid of the 50%)
* [X] add a "add environment" thumbnail in the thumbnail view (also for machines)
* [X] Notification bars are not completely lined up with the "well"
* [X] first/second in registration should be translated
* [X] twitter handle should be added
* [X] when adding email address to registration, it should automatically load gravatar image
* [X] Display comments to software / hardware / operating systems