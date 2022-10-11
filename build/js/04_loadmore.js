/**
 * Load More Posts
 */
function loadMore(page){

    const showMoreButton = document.getElementById('show-more');
    const showLessButton = document.getElementById('show-less');
    const showAllButton = document.getElementById('show-all')

    const loop = document.getElementById('loaded-posts');
    const otherPosts = document.getElementById('other-posts');

    const holderLessButton = document.getElementById('show-toggle-button-less');
    const holderAllButton = document.getElementById('show-toggle-button-all');
    const holderMoreButton = document.getElementById('show-toggle-button-more');

    const morePostsTimeline = gsap.timeline({
      paused: true, 
    });

    function appearAllButton(){
      if(showAllButton){
        holderAllButton.classList.remove('hide');
        holderAllButton.classList.add('active');
      }
      if(showLessButton){
        holderLessButton.classList.remove('active');
        holderLessButton.classList.add('hide');
      }
    }

    function appearLessButton(){
      if(showAllButton){
        holderAllButton.classList.remove('active');
        holderAllButton.classList.add('hide');
      }
      if(showLessButton){
        holderLessButton.classList.remove('hide');
        holderLessButton.classList.add('active');
      }
    }
    
    if (showMoreButton){
      showMoreButton.addEventListener('click', function(e){
          e.preventDefault();

          const button = this;
          const buttonText = button.querySelector('.text');
          const buttonTextDataInitText = button.dataset.initText;

          const data = new FormData();
          data.append('action', 'loadmore');
          data.append('query', loadmore_params.posts);
          data.append('page', page);
          
          buttonText.innerHTML = 'Loading ...';

          fetch(
            loadmore_params.ajaxurl, 
            {
              method: 'POST',
              body : data,
            })
          .then( res => res.json() )
          .then( function(data){

            //console.log(`page: ${page}, maxPage: ${loadmore_params.max_page}`);

            if (data.success === true){
              const d = data.data;
              loop.insertAdjacentHTML('beforeend', d);

              loop.classList.remove('full-loaded');
              otherPosts.classList.remove('full-loaded');
              buttonText.innerHTML = buttonTextDataInitText;

            } else {
              loop.classList.add('full-loaded');
              otherPosts.classList.add('full-loaded');
              buttonText.innerHTML = 'No more posts';
            }

            page++;

          })
          .catch( function(error){
            buttonText.innerHTML = 'Error';
          });
          
      });
    }

    if (showLessButton){
      showLessButton.addEventListener('click', function(){
        morePostsTimeline.to(
          loop, 
          {
            height: '0',
            duration: 0.6,
            onComplete: appearAllButton,
          }
        )
        morePostsTimeline.play();
      })
    }

    if (showAllButton){
      showAllButton.addEventListener('click', function(){
        morePostsTimeline.to(
          loop, 
          {
            height: 'auto',
            duration: 0.6,
            onComplete: appearLessButton,
          }
        )
        morePostsTimeline.play();
      })
    }

};