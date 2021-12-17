FROM golang:1.15.6-alpine

ENV MYPATH /code

RUN mkdir -p "$MYPATH" && chmod -R 777 "$MYPATH"

WORKDIR $MYPATH

VOLUME ["$MYPATH"]
