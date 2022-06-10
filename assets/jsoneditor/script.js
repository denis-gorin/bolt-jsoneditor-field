

const loadScript = (source, beforeEl, async = true, defer = true) => {
  return new Promise((resolve, reject) => {
    let script = document.createElement('script');
    const prior = beforeEl || document.getElementsByTagName('script')[0];

    script.async = async;
    script.defer = defer;

    function onloadHander(_, isAbort) {
      if (isAbort || !script.readyState || /loaded|complete/.test(script.readyState)) {
        script.onload = null;
        script.onreadystatechange = null;
        script = undefined;

        if (isAbort) {
          reject();
        } else {
          resolve();
        }
      }
    }

    script.onload = onloadHander;
    script.onreadystatechange = onloadHander;

    script.src = source;
    prior.parentNode.insertBefore(script, prior);
  });
}

const container = document.getElementById("jsoneditor")
if (container) {
  //cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.5.7/jsoneditor-minimalist.min.js
  // loadScript('//cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.5.7/jsoneditor.min.js', null, false, true).then(() => {
  loadScript('//cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.8.0/jsoneditor.min.js', null, false, true).then(() => {
    
    // let NewElement = document.createElement('link');
    // NewElement.rel = 'stylesheet';
    // NewElement.href = '//cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.5.7/jsoneditor.css';
    // let head = document.querySelector('head')
    // NewElement.appendAfter(head)
    
    initEditor()
  
  }, () => {
    console.log('fail to load script jsoneditor');
  });
  
  
  const initEditor = function () {
    // create the editor
    const valueContainer = document.querySelector("#initialValue textarea")
    let initialValue = valueContainer.value
  
    // https://github.com/josdejong/jsoneditor/blob/master/docs/api.md
    const options = {
      mode: 'form',
      modes: ['code', 'form'], // allowed modes
      onChange: () => {
        const updatedJson = editor.get()
        valueContainer.value = JSON.stringify(updatedJson)
      },
      onModeChange: function (newMode, oldMode) {
        console.log('Mode switched from', oldMode, 'to', newMode)
      }
    }
    const editor = new JSONEditor(container, options)
   
    // set json
    initialValue = initialValue.replace(/​/g,'').replace(/​​/g,'') // NOTE: invisible space here
    // console.log('initialValue', typeof initialValue);
    // console.log('initialValue', initialValue);
    const initialJson = initialValue && JSON.parse(initialValue)
    initialJson && editor.set(initialJson)
  }
}
