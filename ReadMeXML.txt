
1. SaveXML()
Создаем пустую строку xmlString, в которую, проходясь циклом по таблце, 
добавляем значения + тэги, после чего заносим это в localStorage.

2. LoadXML()
загружает XML и XSL текст.
определяет тип браузера.
если браузер поддерживает ActiveX объекты:
с помощью метода transformNode() таблица стилей XSL применяется к XML документу.
формируется тело текущего документа.
если браузер клиента не поддерживает ActiveX объекты:
создается новый объект XSLTProcessor и в него импортируется XSL файл.
с помощью метода transformToFragment() таблица стилей XSL применяется к XML документу.
формируется тело текущего документа.