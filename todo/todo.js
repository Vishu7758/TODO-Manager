const validate = () => {
    let todo_msg = document.forms['todo-form']['txt_todo'].value;
    todo_msg = todo_msg.trim()
    if (todo_msg.length === 0) {
        alert('Please insert something in todo');
        return false;
    }
    return true;
}